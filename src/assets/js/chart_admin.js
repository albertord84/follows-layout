
$(document).ready(function () {
    var ACTIVE=[];
    var BLOCKED_BY_PAYMENT=[];
    var BLOCKED_BY_INSTA=[];
    var VERIFY_ACCOUNT=[];
    var BLOCKED_BY_TIME=[];
    var PAYING_CUSTOMERS=[];
    for(i=0;i<DATAS.length;i++) {
        date = new Date(DATAS[i]['date']*1000);
        ACTIVE.push({'x':date, 'y':parseInt(DATAS[i]['ACTIVE'])});
        BLOCKED_BY_PAYMENT.push({'x':date, 'y':parseInt(DATAS[i]['BLOCKED_BY_PAYMENT'])});
        BLOCKED_BY_INSTA.push({'x':date, 'y':parseInt(DATAS[i]['BLOCKED_BY_INSTA'])});
        VERIFY_ACCOUNT.push({'x':date, 'y':parseInt(DATAS[i]['VERIFY_ACCOUNT'])});
        BLOCKED_BY_TIME.push({'x':date, 'y':parseInt(DATAS[i]['BLOCKED_BY_TIME'])});
        if(parseInt(DATAS[i]['PAYING_CUSTOMERS']))
            PAYING_CUSTOMERS.push({'x':date, 'y':parseInt(DATAS[i]['PAYING_CUSTOMERS'])});
    }
        
    chart1 = new CanvasJS.Chart("chartContainer", {
        title: {
         text: "Quantidade diária por Status",
         fontSize: 30
         },
        zoomEnabled: true, 
        animationEnabled: true,
        animationDuration: 2500,
        axisX: {
            gridThickness: 0.5,
            gridColor: "Silver",
            tickThickness: 5,
            tickColor: "silver",
	    valueFormatString: "DD/MM/YY"
         },
        toolTip: {
            shared: true
        },
        theme: "theme2",
        axisY: {
            gridThickness: 0.5,
            tickThickness: 5,
            gridColor: "Silver",
            tickColor: "silver"
        },
        legend: {
            verticalAlign: "center",
            horizontalAlign: "right"
        },
        data: [
            {
                type: "line",
                showInLegend: true,
                lineThickness: 2,
                name: 'ACTIVE',
                markerType: "square",
                color: "green",
                dataPoints: ACTIVE
            },
            {
                type: "line",
                showInLegend: true,                
                name: 'B_PAYMENT',
                color: "red",
                lineThickness: 2,
                dataPoints: BLOCKED_BY_PAYMENT                
            },
            {
                type: "line",
                showInLegend: true,                
                name: 'B_INSTA',
                color: "blue",
                lineThickness: 2,
                dataPoints: BLOCKED_BY_INSTA                
            },
            {
                type: "line",
                showInLegend: true,                
                name: 'V_ACCOUNT',
                color: "black",
                lineThickness: 2,
                dataPoints: VERIFY_ACCOUNT                
            },
            {
                type: "line",
                showInLegend: true,                
                name: 'B_TIME',
                color: "orange",
                lineThickness: 2,
                dataPoints: BLOCKED_BY_TIME                
            },
            {
                type: "line",
                showInLegend: true,                
                name: 'PAYING_CUSTOMERS',
                color: "purple",
                lineThickness: 6,
                dataPoints: PAYING_CUSTOMERS                
            },
        ],
        legend: {
            cursor: "pointer",
            itemclick: function (e) {
                if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                    e.dataSeries.visible = false;
                } else {
                    e.dataSeries.visible = true;
                }
                chart1.render();
            }
        }
    });    
    chart1.render();
    
    chart2 = new CanvasJS.Chart("chartContainer2", {
        title: {
         text: "Crescimento (Clientes pagantes)",
         fontSize: 30
         },
        zoomEnabled: true, 
        animationEnabled: true,
        animationDuration: 2500,
        axisX: {
            gridThickness: 0.5,
            gridColor: "Silver",
            tickThickness: 5,
            tickColor: "silver",
	    valueFormatString: "DD/MM/YY"
         },
        toolTip: {
            shared: true
        },
        theme: "theme2",
        axisY: {
            gridThickness: 0.5,
            tickThickness: 5,
            gridColor: "Silver",
            tickColor: "silver"
        },
        legend: {
            verticalAlign: "center",
            horizontalAlign: "right"
        },
        data: [            
            {
                type: "column",
                showInLegend: true,                
                name: 'PAYING_CUSTOMERS',
                color: "purple",
                lineThickness: 6,
                dataPoints: PAYING_CUSTOMERS                
            },
        ],
        legend: {
            cursor: "pointer",
            itemclick: function (e) {
                if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                    e.dataSeries.visible = false;
                } else {
                    e.dataSeries.visible = true;
                }
                chart2.render();
            }
        }
    });    
    chart2.render();
});
