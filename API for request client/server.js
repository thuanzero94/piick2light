var net = require("net");
var mysql = require("mysql");

var con = mysql.createConnection({
	host: "localhost",
	user: "root",
	password: "12345678",
	database: "pick2light"
});

var server = net.createServer(function(client){
	client.setTimeout(1000);
	server.getConnections(function (err, count) {
        if(!err)
        {
            console.log("PI %d connections now. ", count);
        }else
        {
            console.error(JSON.stringify(err));
        }
    });
	client.on('data', function(data){
		data += "";
		var last = data.lastIndexOf(".");
		console.log("Client Input: "+data.substring(0, last));
		var positionRack = data.substring(0, last);
		
		con.connect(function(err){
			var query = 
				"SELECT `models`.`name` as 'ModelName', `models`.`keypart` as 'KeypartNO', `line`.`number` as 'LineNumber', `line`.`name` as 'LineName', `racks`.`name` as 'RackNumber', `slots`.`name` as 'SlotName' "
				+" FROM `racks` "
				+" INNER JOIN `line` ON `racks`.`id_line` = `line`.`id` "
				+" INNER JOIN `slots` ON `racks`.`id` = `slots`.`id_rack` "
				+" LEFT JOIN `models` ON `slots`.`id_model` = `models`.`id` "
				+" WHERE `racks`.`name` LIKE '"+positionRack+"'"
				+" ORDER BY `SlotName` ASC "
				+" LIMIT 0,4 ";
			con.query(query, function(err, result, fields){
				
				var resObj = {};
				try{
					if(result[0] != null){
						console.log("Data: "+result[0]['ModelName']);
						var modelSlot1 = modelSlot2 = modelSlot3 = modelSlot4 = "";
						var keyS1 = keyS2 = keyS3 = keyS4 = "";
						if(result[0]['ModelName'] != null){
							var modelSlot1 = result[0]['ModelName']+"";
							var keyS1 = result[0]['KeypartNO']+"";
						}
						if(result[1]['ModelName'] != null){
							var modelSlot2 = result[1]['ModelName']+"";
							var keyS2 = result[1]['KeypartNO']+"";
						}
						if(result[2]['ModelName'] != null){
							var modelSlot3 = result[2]['ModelName']+"";
							var keyS3 = result[2]['KeypartNO']+"";
						}
						if(result[3]['ModelName'] != null){
							var modelSlot4 = result[3]['ModelName']+"";
							var keyS4 = result[3]['KeypartNO']+"";
						}
						
						var resObj = 
						{
							"SLOT1": modelSlot1,
							"KEYSLOT1": keyS1, 
							"SLOT2": modelSlot2,
							"KEYSLOT2": keyS2, 
							"SLOT3": modelSlot3,
							"KEYSLOT3": keyS3, 
							"SLOT4": modelSlot4,
							"KEYSLOT4": keyS4, 
							"LINENAME": result[0]['LineName'],
							"LINENUMBER": result[0]['LineNumber'],
							"RACKNUMBER": result[0]['RackNumber']
						};
					}
				}catch(e){

				}
				data = JSON.stringify(resObj);
                client.end(data);
			});
		});
		console.log("Input: "+data);
	});

	client.on('end', function () {
        console.log('Client disconnect.');
        server.getConnections(function (err, count) {
            if(!err)
            {
                //console.log("PI %d connections now. ", count);
            }else
            {
                console.error(JSON.stringify(err));
            }
        });
    });

    client.on('timeout', function () {
        console.log('Client request time out. ');
    });
});

server.listen(1996, function () {

    var serverInfo = server.address();

    var serverInfoJson = JSON.stringify(serverInfo);

    console.log('TCP server listen on address : ' + serverInfoJson);

    server.on('close', function () {
        console.log('TCP server socket is closed.');
    });

    server.on('error', function (error) {
        console.error(JSON.stringify(error));
    });

    server.on('data', function(data){
    	console.log("GetData: "+data);
    });
});