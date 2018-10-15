$(document).ready(function () {
//    new_ACTIVE=[];
//    for(i=0;i<ACTIVE.length;i++) {
//        rep = ACTIVE[i];
//        x = new Date(rep['date'].getFullYear(),rep['date'].getMonth(),rep['date'].getDate());
//        y = rep['amount'];
//        new_ACTIVE.push([x,y]);
//    }
        

    var options = {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Estatística diária"
	},
	axisX:{
		valueFormatString: "DD MMM"
	},
	axisY: {
		title: "Clientes",
		suffix: "",//"K",
		minimum: 0
	},
	toolTip:{
		shared:true
	},  
	legend:{
		cursor:"pointer",
		verticalAlign: "bottom",
		horizontalAlign: "left",
		dockInsidePlotArea: true,
		itemclick: toogleDataSeries
	},
	data: [
            //serie 1
            {
		type: "line",
		showInLegend: true,
		name: "ACTIVE",
		markerType: "square",
		xValueFormatString: "DD MMM, YYYY",
		color: "#F08080",
		yValueFormatString: "#,##0K",
		dataPoints: /*new_ACTIVE*/
                [
                    { x: new Date(2010, 0, 3), y: 650 },
                    { x: new Date(2010, 0, 5), y: 700 },
                    { x: new Date(2010, 0, 7), y: 710 },
                    { x: new Date(2010, 0, 9), y: 658 },
                    { x: new Date(2010, 0, 11), y: 734 },
                    { x: new Date(2010, 0, 13), y: 963 },
                    { x: new Date(2010, 0, 15), y: 847 },
                    { x: new Date(2010, 0, 17), y: 853 },
                    { x: new Date(2010, 0, 19), y: 869 },
                    { x: new Date(2010, 0, 21), y: 943 },
                    { x: new Date(2010, 0, 23), y: 970 }
                ]
            },
            //serie 2
//            { 
//		type: "line",
//		showInLegend: true,
//		name: "B_PAYMENT",
//		lineDashType: "dash",
//                markerType: "triangle",
//		yValueFormatString: "#,##0K",
//		dataPoints: BLOCKED_BY_PAYMENT
//            },
//            //serie 3
//            { 
//		type: "line",
//		showInLegend: true,
//		name: "B_INSTA",
//		lineDashType: "dash",
//		yValueFormatString: "#,##0K",
//		dataPoints: BLOCKED_BY_INSTA
//            },
//            //serie 4
//            { 
//		type: "line",
//		showInLegend: true,
//		name: "DELETED",
//		lineDashType: "dash",
//		yValueFormatString: "#,##0K",
//		dataPoints: DELETED
//            },
//            //serie 5
//            { 
//		type: "line",
//		showInLegend: true,
//		name: "UNFOLLOW",
//		lineDashType: "dash",
//		yValueFormatString: "#,##0K",
//		dataPoints: UNFOLLOW
//            },
//            //serie 6
//            { 
//		type: "line",
//		showInLegend: true,
//		name: "V_ACCOUNT",
//		lineDashType: "dash",
//		yValueFormatString: "#,##0K",
//		dataPoints: VERIFY_ACCOUNT
//            },
//            //serie 7
//            { 
//		type: "line",
//		showInLegend: true,
//		name: "B_TIME",
//		lineDashType: "dash",
//		yValueFormatString: "#,##0K",
//		dataPoints: BLOCKED_BY_TIME
//            }
        ]
    };
    $("#chartContainer").CanvasJSChart(options);

    function toogleDataSeries(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	} else{
		e.dataSeries.visible = true;
	}
	e.chart.render();
    }
    
    
    
    
    
    
    

});
