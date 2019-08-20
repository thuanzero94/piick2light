from tkinter import Tk, ttk, Label, Text, Frame, NO, \
    StringVar, BOTTOM, X, END, Button,messagebox, Checkbutton,IntVar, BooleanVar
import sys, threading, socket, time, json, os
import  logging, traceback,serial
import RPi.GPIO as GPIO
# configuration for log file
logging.basicConfig(filename='app.log', filemode='w', format='[%(asctime)s] p%(process)s {%(pathname)s:%(lineno)d} |%(levelname)s - %(message)s')
# mode flag
runWhile = True
hasError = False
runTimer = True
class Configuration():
    def __init__(self):
        self.path = "settings.json"
        self.defaultData = {"sizeUI":"1024x550","ipServer":"10.239.106.131", "portServer":1996, "comPort1":"/dev/ttyUSB0",\
                            "comPort2":"/dev/ttyUSB1","baudComPort": 9600, "GPIOSlot1":2, "GPIOSlot2":3,"GPIOSlot3":17, "GPIOSlot4":27,"DoubleRack":False, "packName":"P2.1", "backGround":"linen"}
        self.data = None
        self.sizeUI = None
        self.ipServer = None
        self.portServer = None
        self.comPort1 = None
        self.comPort2 = None
        self.baudComPort = None
        self.GPIOSlot1 = None
        self.GPIOSlot2 = None
        self.GPIOSlot3 = None
        self.GPIOSlot4 = None
        self.packName = None
        self.backGround = None
        self.doubleRack = None
        self.modelNameInSlot = ["","","",""]
        self.keyPartInSlot = ["","","",""]
        # Add version config
        self.version = None
        self.init()

    def init(self):
        ''' initialization data for configuration '''
        _FileExists = os.path.isfile(self.path)
        if not _FileExists:
            with open(self.path, "a+") as f:
                f.write(json.dumps(self.defaultData))
            self.data = self.defaultData
        else:
            with open(self.path, "r+") as f:
                self.data = json.load(f)
        self.sizeUI         = self.data["sizeUI"]
        self.ipServer       = self.data["ipServer"]
        self.portServer     = self.data["portServer"]
        self.comPort1       = self.data["comPort1"]
        self.comPort2       = self.data["comPort2"]
        self.baudComPort    = self.data["baudComPort"]
        self.GPIOSlot1      = self.data["GPIOSlot1"]
        self.GPIOSlot2      = self.data["GPIOSlot2"]
        self.GPIOSlot3      = self.data["GPIOSlot3"]
        self.GPIOSlot4      = self.data["GPIOSlot4"]
        self.packName       = self.data["packName"]
        self.backGround     = self.data["backGround"]
        self.doubleRack     = self.data["DoubleRack"]
        self.version        = self.data["version"]

    def update(self, key, value):
        self.data[key] = value
        with open(self.path, "w") as f:
            json.dump(self.data, f)
        self.init()


class Interface():
    def __init__(self):

        self.ui = Tk()
        self.ui.title("Pick to Light {} - Designed by SWRD Alan".format(config.version))
        try:
            self.ui.geometry(config.sizeUI)
        except:
            self.ui.geometry(config.defaultData["sizeUI"])
            config.sizeUI = config.defaultData["sizeUI"]
        self.ui.protocol("WM_DELETE_WINDOW", self.closing)
        self.tab_control = ttk.Notebook(self.ui)
        self.home = Frame(self.tab_control)
        self.home.configure(background=config.backGround)
        self.settings = Frame(self.tab_control)
        self.settings.configure(background=config.backGround)
        self.tab_control.add(self.home, text="Home")
        self.tab_control.add(self.settings, text="Settings")
        self.tab_control.pack(expand=1, fill='both')
        self.ui.update()
        self.sizeFont = min(self.ui.winfo_height(), self.ui.winfo_width()) / 23

        # initialization Home tablel
        self.status = StringVar()
        self.LineNameH = StringVar()
        self.RackNameH = StringVar()
        self.ModelNameH = StringVar()
        self.KeyPartNoH = StringVar()
        self.NextModelH = StringVar()
        self.NextKeyPartH = StringVar()
        self.RackRun = StringVar()
        self.ModelRun = StringVar()
        self.KeyPartRun = StringVar()
        self.SlotRun = StringVar()
        self.Labelstatus = Label(self.home, textvariable=self.status, bg="green" , fg="white", \
                                 font=("Courier", round(self.sizeFont / 1.5), "bold"))
        #initialization Setting table
        self.IPServerTextbox = Text(self.settings, font=("Courier", round(self.sizeFont / 2)), width=15, height=1)
        self.PortServerTextbox = Text(self.settings, font=("Courier", round(self.sizeFont / 2)), width=6, height=1)
        self.CMC1Textbox = Text(self.settings, font=("Courier", round(self.sizeFont / 2)), width=15, height=1)
        self.CMC2Textbox = Text(self.settings, font=("Courier", round(self.sizeFont / 2)), width=15, height=1)
        self.BaudRateTextbox = Text(self.settings, font=("Courier", round(self.sizeFont / 2)), width=15, height=1)
        self.RackNameTextbox = Text(self.settings, font=("Courier", round(self.sizeFont / 2)), width=10, height=1)
        self.DoubelCheckBox = BooleanVar()
        self.DoubleRackCheckbox = Checkbutton(self.settings, text="Double Rack", variable=self.DoubelCheckBox, bg = config.backGround)
        self.GPIOSlot1 = Text(self.settings, font=("Courier", round(self.sizeFont / 2)), width=3, height=1)
        self.GPIOSlot2 = Text(self.settings, font=("Courier", round(self.sizeFont / 2)), width=3, height=1)
        self.GPIOSlot3 = Text(self.settings, font=("Courier", round(self.sizeFont / 2)), width=3, height=1)
        self.GPIOSlot4 = Text(self.settings, font=("Courier", round(self.sizeFont / 2)), width=3, height=1)
        self.ResolutionGUITextbox = Text(self.settings, font=("Courier", round(self.sizeFont / 2)), width=15, height=1)
        self.BackGroundTextbox = Text(self.settings, font=("Courier", round(self.sizeFont / 2)), width=15, height=1)
        self.setStatus()
        self.initHomeTab()
        self.initSettingsTab()

    def initHomeTab(self):
        height = self.ui.winfo_height() / 15
        width = self.ui.winfo_width() / 2
        position = 1
        self.setLabelHome("Line :", 20, position * height, "grey")
        self.setValueHome(self.LineNameH, round(self.sizeFont) * len("Line :"), position * height, "green")
        self.setLabelHome("Rack Position :", round(self.sizeFont) * 2 + width, position * height, "grey")
        self.setValueHome(self.RackNameH, round(self.sizeFont) * len("Rack Position :") + width, position * height, "green")
        # Set Running
        position = 3
        self.setLabelHome("RUNNING - ", width - round(self.sizeFont) * 6, position * height)
        self.setValueHome(self.SlotRun, width - round(self.sizeFont) * (6 - len("RUNNING ")), position * height)
        position = 4
        self.setLabelHome("Rack     :", width - round(self.sizeFont) * 10, position * height)
        self.setValueHome(self.RackRun, width - round(self.sizeFont) * (10 - len("Rack     ")), position * height)
        position = 5
        self.setLabelHome("Model    :", width - round(self.sizeFont) * 10, position * height)
        self.setValueHome(self.ModelRun, width - round(self.sizeFont) * (10 - len("Model    ")), position * height)
        position = 6
        self.setLabelHome("Key Part :", width - round(self.sizeFont) * 10, position * height)
        self.setValueHome(self.KeyPartRun, width - round(self.sizeFont) * (10 - len("Key Part ")), position * height)
        # Slot Name
        position = 9
        self.setLabelHome("SLOT 1", round(self.sizeFont) * 2, position * height, "blue4")
        self.setLabelHome("SLOT 2", round(self.sizeFont) * 2 + width, position * height, "black")
        # Model
        position = 10
        self.setLabelHome("Model    :", 20, position * height, "blue4")
        self.setValueHome(self.ModelNameH, round(self.sizeFont) * len("Model    "), position * height)
        self.setLabelHome("Model    :", 20 + width, position * height, "black")
        self.setValueHome(self.NextModelH, round(self.sizeFont) * len("Model    ") + width, position * height)
        # Key Part
        position = 11
        self.setLabelHome("Key Part :", 20, position * height, "blue4")
        self.setValueHome(self.KeyPartNoH, round(self.sizeFont) * len("Key Part "), position * height)
        self.setLabelHome("Key Part :", 20 + width, position * height, "black")
        self.setValueHome(self.NextKeyPartH, round(self.sizeFont) * len("Key Part ") + width, position * height)

        self.Labelstatus.pack(fill=X, side=BOTTOM)

    def initSettingsTab(self):
        height = self.ui.winfo_height() / 15
        positions = 1
        self.setLabelSettings("Server IP:", 20, positions * height)
        self.IPServerTextbox.insert(END, config.ipServer)
        self.IPServerTextbox.place(x=20 + len("Server IP:") * self.sizeFont / 2, y=positions * height)
        self.setLabelSettings("Server PORT:",x = 20 + (len("Server IP:")+15 )* self.sizeFont / 2 , y=positions * height)
        self.PortServerTextbox.insert(END, config.portServer)
        self.PortServerTextbox.place(x=20 + (len("Server PORT:") + len("Server IP:") + 15)*self.sizeFont/2  , y=positions * height)
        positions = 3
        self.setLabelSettings("CMC 1:", 20, positions * height)
        self.CMC1Textbox.insert(END, config.comPort1)
        self.CMC1Textbox.place(x=20 + 6 * self.sizeFont / 2 , y=positions * height)
        self.setLabelSettings("CMC 2:", 20 + (15 + 6) * self.sizeFont / 2 , positions * height)
        self.CMC2Textbox.insert(END, config.comPort2)
        self.CMC2Textbox.place(x=20 + (21 + 6) * self.sizeFont / 2, y=positions * height)
        self.setLabelSettings("Baud:", 20 + (36 + 6) * self.sizeFont / 2, positions * height)
        self.BaudRateTextbox.insert(END, config.baudComPort)
        self.BaudRateTextbox.place(x=20 + (41 + 6) * self.sizeFont / 2, y=positions * height)

        positions = 5

        self.setLabelSettings("Rack Name:", 20, positions * height)
        self.RackNameTextbox.insert(END, config.packName)
        self.RackNameTextbox.place(x=20 + 10 * self.sizeFont / 2, y=positions * height)
        self.setLabelSettings("Rack Name:", 20, positions * height)
        self.DoubleRackCheckbox.place(x=20 + 25 * self.sizeFont / 2, y=positions * height)
        self.DoubelCheckBox.set(config.doubleRack)

        positions = 7
        self.setLabelSettings("GPIO Slot1:", 20, positions * height)
        self.GPIOSlot1.insert(END, config.GPIOSlot1)
        self.GPIOSlot1.place(x=20 + (11) * self.sizeFont / 2, y=positions * height)

        self.setLabelSettings("GPIO Slot2:", 20 + (15) * self.sizeFont / 2 , positions * height)
        self.GPIOSlot2.insert(END, config.GPIOSlot2)
        self.GPIOSlot2.place(x= 20 +26 * self.sizeFont / 2, y=positions * height)

        self.setLabelSettings("GPIO Slot3:", 20 + 30 * self.sizeFont / 2 , positions * height)
        self.GPIOSlot3.insert(END, config.GPIOSlot3)
        self.GPIOSlot3.place(x=20 + 41 * self.sizeFont / 2, y=positions * height)

        self.setLabelSettings("GPIO Slot4:", 20 + 44 * self.sizeFont / 2 , positions * height)
        self.GPIOSlot4.insert(END, config.GPIOSlot4)
        self.GPIOSlot4.place(x=20 + 55 * self.sizeFont / 2, y=positions * height)

        positions = 9

        self.setLabelSettings("Graphical User Interface Resolution:", 20 , positions * height)
        self.ResolutionGUITextbox.insert(END, config.sizeUI)
        self.ResolutionGUITextbox.place(x=20 + 36 * self.sizeFont / 2, y=positions * height)

        positions = 11

        self.setLabelSettings("BackGround :", 20, positions * height)
        self.BackGroundTextbox.insert(END, config.backGround)
        self.BackGroundTextbox.place(x=20 + 12 * self.sizeFont / 2, y=positions * height)

        bt = Button(self.settings, text="Update", \
                    font=("Courier", round(self.sizeFont / 2), "bold"), fg="green", command=self.updateParameter)
        bt.place(x=20 + 30 * self.sizeFont / 2, y=positions * height - round(self.sizeFont / 4))

    def updateParameter(self):
        config.update("ipServer", self.IPServerTextbox.get("1.0", END).strip())
        config.update("portServer", (int)(self.PortServerTextbox.get("1.0", END).strip()))
        config.update("comPort1", (self.CMC1Textbox.get("1.0", END).strip()))
        config.update("comPort2", (self.CMC2Textbox.get("1.0", END).strip()))
        config.update("baudComPort", (int)(self.BaudRateTextbox.get("1.0", END).strip()))
        config.update("GPIOSlot1", (int)(self.GPIOSlot1.get("1.0", END).strip()))
        config.update("GPIOSlot2", (int)(self.GPIOSlot2.get("1.0", END).strip()))
        config.update("GPIOSlot3", (int)(self.GPIOSlot3.get("1.0", END).strip()))
        config.update("GPIOSlot4", (int)(self.GPIOSlot4.get("1.0", END).strip()))
        config.update("packName", self.RackNameTextbox.get("1.0", END).strip())
        config.update("packName", self.RackNameTextbox.get("1.0", END).strip())
        config.update("backGround", self.BackGroundTextbox.get("1.0", END).strip())
        config.update("sizeUI", self.ResolutionGUITextbox.get("1.0", END).strip())
        config.update("DoubleRack", self.DoubelCheckBox.get())
        print(self.DoubelCheckBox.get())
        messagebox.showinfo("Information", "Please restart the program to update")
        self.closing()
    def setStatus(self, message = "Running", bg = "green"):
        self.status.set(message)
        self.Labelstatus.config(bg = bg)

    def setLabelHome(self, name, x, y , color = "green"):
        label = Label(self.home, text=name, font=("Courier", round(self.sizeFont), "bold"))
        label.config(bg=config.backGround, fg=color)
        label.place(x=round(x), y=round(y))

    def setValueHome(self, value, x, y, color = "red"):
        value = Label(self.home, textvariable=value, font=("Courier", round(self.sizeFont), "bold"))
        value.config(bg=config.backGround, fg=color)
        value.place(x=round(x), y=round(y))

    def setLabelSettings(self, name, x, y):
        label = Label(self.settings, text=name, font=("Courier", round(self.sizeFont / 2)))
        label.config(bg=config.backGround, fg="black")
        label.place(x=round(x), y=round(y))
    def closing(self):
        global runWhile
        runWhile = False
        GPIO.output(config.GPIOSlot1, 0)
        GPIO.output(config.GPIOSlot2, 0)
        if(config.doubleRack):
            try:
                GPIO.output(config.GPIOSlot3, 0)
                GPIO.output(config.GPIOSlot4, 0)
            except:
                pass
        GPIO.cleanup()
        self.ui.destroy()

    def Dialog(self):
        self.ui.mainloop()

class ReadCMC(threading.Thread):
    def __init__(self, Reference):
        threading.Thread.__init__(self)
        self.Reference = Reference
        self.state = False
        self.Serial = None
        try:
            if (self.Reference == 1):
                self.Serial = serial.Serial(port= config.comPort1, baudrate = config.baudComPort)
            elif (self.Reference == 2):
                self.Serial = serial.Serial(port= config.comPort2, baudrate = config.baudComPort)
                self.state = True
        except:
            UI.setStatus("Open COM Port fail!", "red")
            messagebox.showinfo("Error", traceback.format_exc())
            logging.error(traceback.format_exc())
    def run(self):
        if(self.Serial != None):
            if(not self.Serial.is_open):
                self.Serial.open()
            self.Serial.timeout = 1
            self.ReadData()
    def ReadData(self):
        while runWhile:
            time.sleep(0.1)
            if(SV.state):
                data = b''
                while runWhile:
                    s = self.Serial.read()
                    if (s.decode() != chr(0x00) and s.decode() != chr(0x1F)):
                        data += s
                    if(s == b'\r'):
                        break
                try:
                    self.Processing(data.decode())
                except:
                    logging.error(traceback.format_exc())
            else:
                continue
    def Processing(self,data):
        logging.info("SF Send: {}".format(data))
        sqlData = data.split("^")
        matching = False
        if(self.Reference == 1):
            GPIO1 = config.GPIOSlot1
            GPIO2 = config.GPIOSlot2
            Model1 = config.modelNameInSlot[0]
            Model2 = config.modelNameInSlot[1]
            KeyPart1 = config.keyPartInSlot[0]
            KeyPart2 = config.keyPartInSlot[1]
        elif(self.Reference == 2):
            GPIO1 = config.GPIOSlot3
            GPIO2 = config.GPIOSlot4
            Model1 = config.modelNameInSlot[2]
            Model2 = config.modelNameInSlot[3]
            KeyPart1 = config.keyPartInSlot[2]
            KeyPart2 = config.keyPartInSlot[3]
        GPIO.output(GPIO1, 0)
        GPIO.output(GPIO2, 0)
        if (len(sqlData) == 3):
            if ("PASS" in sqlData[2].upper() and Model1 != "" and Model2 != ""):
                if (Model1 in sqlData[0] or sqlData[0] in Model1):
                    # UI.ModelNameH.set(Model1)
                    # UI.KeyPartNoH.set(sqlData[1])
                    # UI.NextModelH.set(Model2)
                    # UI.NextKeyPartH.set(KeyPart2)
                    UI.ModelRun.set(Model1)
                    UI.KeyPartRun.set(sqlData[1])
                    UI.SlotRun.set("SLOT 1")
                    UI.RackRun.set(config.packName + ".1")
                    # if(self.Reference == 1):
                    #    UI.RackNameH.set(config.packName + ".1")
                    # else:
                    #    UI.RackNameH.set(config.packName + ".1")

                    GPIO.output(GPIO1, 1)
                    # led_off_timer(GPIO1).start()
                    matching = True
                elif (Model2 in sqlData[0] or sqlData[0] in Model2):
                    # UI.ModelNameH.set(Model2)
                    # UI.KeyPartNoH.set(sqlData[1])
                    # UI.NextModelH.set(Model1)
                    # UI.NextKeyPartH.set(KeyPart1)
                    UI.ModelRun.set(Model2)
                    UI.KeyPartRun.set(sqlData[1])
                    UI.SlotRun.set("SLOT 2")
                    UI.RackRun.set(config.packName + ".2")
                    # if(self.Reference == 1):
                    #    UI.RackNameH.set(config.packName + ".2")
                    # else:
                    #    UI.RackNameH.set(config.packName + ".2")
                    GPIO.output(GPIO2, 1)
                    # led_off_timer(GPIO2).start()
                    matching = True
                if(not matching):
                    UI.setStatus("\"{}\" model incorrect!".format(sqlData[0]), "red")
                    self.state = False
                elif(not self.state):
                    UI.setStatus("Running!", "green")
                    self.state = True
            else:
                SV.ShowData(None)
                UI.setStatus("Fail for \"{}\" model!".format(sqlData[0]), "red")
                self.state = True
        # FxVN AlanRD - Check Link DONEPASS -> Turn off light
        elif (len(sqlData) == 4):
            global runTimer
            if ("PASSDONE" in sqlData[3]):
                logging.info('LINK COMPLETE. Turn off light')
                GPIO.output(GPIO1, 0)
                GPIO.output(GPIO2, 0)
                runTimer = False
        else:
            SV.ShowData(None)
            UI.setStatus("Data IT incorrect!", "red")
            logging.error("data IT incorrect! ({})".format(data))
            self.state = True
class ServerCommunication(threading.Thread):
    def __init__(self):
        threading.Thread.__init__(self)
        self.state = True
    def run(self):
        self.ShowData(None)
        while runWhile:
            self.Connection()
            time.sleep(2)
    def Connection(self):
        packStatus = (config.packName + ".Status").upper()
        connection = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
        serAdd = (config.ipServer, config.portServer)
        data = None
        try:
            connection.connect(serAdd)
            connection.sendall(packStatus.encode())
            s = connection.recv(1024)
            string = "data = {}".format(s.decode())
            ldict = {}
            exec (string, globals(), ldict)
            data = ldict["data"]
            if(not self.state):
                self.state = True
                UI.setStatus("Running", "green")
        except:
            logging.error(traceback.format_exc())
            if (self.state):
                self.state = False
                UI.setStatus("Connect to server fail!", "red")
        finally:
            connection.close()
        self.ShowData(data)
    def ShowData(self,data):
        if(data is None):
            UI.LineNameH.set("NONE")
            UI.RackNameH.set("NONE")
            UI.ModelNameH.set("NONE")
            UI.KeyPartNoH.set("NONE")
            UI.NextModelH.set("NONE")
            UI.NextKeyPartH.set("NONE")
            UI.RackRun.set("NONE")
            UI.ModelRun.set("NONE")
            UI.KeyPartRun.set("NONE")
            UI.SlotRun.set("NONE")
            config.modelNameInSlot[0] = ""
            config.modelNameInSlot[1] = ""
            if (config.doubleRack):
                config.modelNameInSlot[2] = ""
                config.modelNameInSlot[3] = ""
        else:
            UI.LineNameH.set(data["LINENUMBER"] + " " + data["LINENAME"])
            config.modelNameInSlot[0] = data["SLOT1"]
            config.modelNameInSlot[1] = data["SLOT2"]
            config.keyPartInSlot[0] = data["KEYSLOT1"]
            config.keyPartInSlot[1] = data["KEYSLOT2"]
            # Alan add Show Name
            UI.RackNameH.set(data["RACKNUMBER"])
            UI.ModelNameH.set(data["SLOT1"])
            UI.KeyPartNoH.set(data["KEYSLOT1"])
            UI.NextModelH.set(data["SLOT2"])
            UI.NextKeyPartH.set(data["KEYSLOT2"])
            if(config.doubleRack):
                config.modelNameInSlot[2] = data["SLOT3"]
                config.modelNameInSlot[3] = data["SLOT4"]
                config.keyPartInSlot[2] = data["KEYSLOT3"]
                config.keyPartInSlot[3] = data["KEYSLOT4"]


# class led_off_timer(threading.Thread):
#     def __init__(self, GPIO_PIN):
#         threading.Thread.__init__(self)
#         self.PIN = GPIO_PIN
#
#     def run(self):
#         logging.info("start timer thread: pin-{}, status-{}".format(self.PIN, GPIO.input(self.PIN)))
#         if GPIO.input(self.PIN):
#             logging.info("Wait {} seconds before turn off GPIO {}....".format(config.lightTimer, self.PIN))
#             start = time.time()
#             while runWhile:
#                 time.sleep(0.1)
#                 if not runTimer:
#                     logging.info("Interrupt Timer")
#                 if time.time() - start > int(config.lightTimer):
#                     GPIO.output(self.PIN, 0)
#                     logging.info("Turn Off GPIO {}".format(self.PIN))
#                     break


config = Configuration()
UI = Interface()
SV = ServerCommunication()
SV.start()
ReadCMC(1).start()
GPIO.setmode(GPIO.BCM)
GPIO.setup(config.GPIOSlot1, GPIO.OUT)
GPIO.setup(config.GPIOSlot2, GPIO.OUT)
GPIO.output(config.GPIOSlot1, 0)
GPIO.output(config.GPIOSlot2, 0)
if(config.doubleRack):
    ReadCMC(2).start()
    GPIO.setup(config.GPIOSlot3, GPIO.OUT)
    GPIO.setup(config.GPIOSlot4, GPIO.OUT)
    GPIO.output(config.GPIOSlot3, 0)
    GPIO.output(config.GPIOSlot4, 0)
UI.Dialog()
