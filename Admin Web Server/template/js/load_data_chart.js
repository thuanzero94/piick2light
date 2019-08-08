window.onload = function() {
  var strDataThu = $("#dataThu").val();
  var strDataChi = $("#dataChi").val();
  var countThu = $("#dataThu").attr('count');
  var countChi = $("#dataChi").attr('count');
  var sumThu = $("#dataThu").attr('sum');
  var sumChi = $("#dataChi").attr('sum');
  var arrDataThu = JSON.parse(strDataThu);
  var arrDataChi = JSON.parse(strDataChi);
  
  console.log(countThu+"__"+countChi);

  // var data_thu = [];
  var dataPoint_thu = [];
  for(var i = 0 ; i < countThu ; i++){
    dataPoint_thu.push({y:arrDataThu[i].value/sumThu*100, label: arrDataThu[i].name});
  }
  // data_thu.push(dataPoint);
  var chart_thu = new CanvasJS.Chart("chart_thu", {
    animationEnabled: true,
    data: [{
      type: "pie",
      startAngle: 240,
      yValueFormatString: "##0.00\"%\"",
      indexLabel: "{label} {y}",
      dataPoints: dataPoint_thu
    }]
  });
  chart_thu.render(); 




  var dataPoint_chi = [];
  for(var i = 0 ; i < countChi ; i++){
    dataPoint_chi.push({y: arrDataChi[i].value/sumChi*100, label: arrDataChi[i].name});
  }
  var chart_chi = new CanvasJS.Chart("chart_chi", {
    animationEnabled: true,
    data: [{
      type: "pie",
      startAngle: 240,
      yValueFormatString: "##0.00\"%\"",
      indexLabel: "{label} {y}",
      dataPoints: dataPoint_chi
    }]
  });
  chart_chi.render();
}