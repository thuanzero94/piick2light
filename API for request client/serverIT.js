var net = require("net");
var mysql = require("mysql");

var con = mysql.createConnection({
	host: "localhost",
	user: "root",
	password: "12345678",
	database: "rack_models"
});


var server = net.createServer(function(client){
	client.setTimeout(1000);
    
	client.on('data', function(data){
        data += "";
        var arr = data.split(",");
        var nameModel = arr[0];
        var lineNumber = arr[1];
        var keypart = arr[2];
        var idKey = 0;
        var idModel = 0;
        var type = "";
		con.connect(function(err){
            var query = "SELECT `models`.`id` FROM `models` WHERE `name` LIKE '"+nameModel+"'";
            con.query(query, function(err, rQuery, fields){
                console.log("Size query: "+rQuery.length);
                if(rQuery[0] != null){
                    idModel = rQuery[0].id;
                    var query1 = "SELECT `adapters`.`id` "
                                +" FROM `adapters` "
                                +" INNER JOIN `models` ON `models`.`id_adapter` = `adapters`.`id` "
                                +" WHERE `adapters`.`name` LIKE '"+keypart+"' AND `models`.`id` = "+idModel;
                    con.query(query1, function(err, rQuery1, fields){
                        console.log("Size query1: "+rQuery1.length);
                        if(rQuery1[0] != null){
                            idKey = rQuery1[0].id;
                            type = "adapter";
                            console.log("Keypart NO(type: adapter): "+idKey);
                        }else{
                            var query2 = "SELECT `documents`.`id` "
                                        +" FROM `documents` "
                                        +" INNER JOIN `models` ON `documents`.`id` = `models`.`id_document`"
                                        +" WHERE `documents`.`name` LIKE '"+keypart+"' AND `models`.`id` = "+idModel;
                            con.query(query2, function(err, rQuery2, fields){
                                console.log("Size query2: "+rQuery2.length);
                                if(rQuery2[0] != null){
                                    idKey = rQuery2[0].id;
                                    type = "document";
                                    console.log("Keypart NO(type: document): "+idKey);
                                }else{
                                    client.end("Don't exists keypart NO with models: "+nameModel);
                                }
                            });
                        }

                        var query3 = "UPDATE `slots` s1 "
                                    +" INNER JOIN ( "
                                        +" SELECT `slots`.`id_rack`, `models`.`name` "
                                        +" FROM `slots` "
                                        +" INNER JOIN `models` ON `slots`.`id_model` = `models`.`id` "
                                        +" ) s2 ON `s1`.`id_rack` = `s2`.`id_rack` "
                                    +" INNER JOIN `racks` ON `racks`.`id` = s1.`id_rack`"
                                    +" INNER JOIN `line` ON `line`.`id` = `racks`.`id_line`"
                                    +" SET `s1`.`running` = 1 "
                                    +" WHERE `racks`.`type` LIKE '"+type+"' AND `line`.`number` LIKE '"+lineNumber+"'"
                                    +" AND s1.`id_model` = "+idModel;
                        con.query(query3, function(err, rQuery3, fields){
                            console.log("Update: "+rQuery3.changedRows+" row");
                            client.end("Update successful.")
                        });
                    });
                }else{
                    client.end("Don't exists model.");
                }
            });
		});
	});

	client.on('end', function () {
        console.log('Client disconnect.');
        server.getConnections(function (err, count) {
            if(!err)
            {
                console.log("IT %d connections now. ", count);
            }else
            {
                console.error(JSON.stringify(err));
            }

        });
    });

    client.on('timeout', function () {
        console.log('Client request time out. ');
    })
});

server.listen(1997, function () {

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
    })
});