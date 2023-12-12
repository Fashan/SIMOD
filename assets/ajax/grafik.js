//indikator dashboard 1


setInterval(function () {
	$.ajax({
		url: base_url + 'sensor/get_data',
		type: 'post',
		dataType: 'json',
		data: 'sensor_id='+$('input#sensor_id').val()+' && barang_id='+$('#barang_id').val(),
		success: function (data) {
			$('#donut-amper').css("--percentage", (data.current / 100) * 100 )   //100
			$('#indikator-amper').text(data.current)  
			$('#donut-volt').css("--percentage",(data.voltage /260) * 100 )  //260
			$('#indikator-volt').text(data.voltage)  
			$('#donut-watt').css("--percentage",(data.power /1000) * 100 )  //1000
			$('#indikator-watt').text(data.power)     
			$('#donut-kwh').css("--percentage",(data.energy / 600)*100 )  //600
			$('#indikator-kwh').text(data.energy)   
		}
	});
	}, 1000);



	// grafik harian
	var ctx4 = document.getElementById("chart-line2").getContext("2d");

	var grafik_ctx4 = new Chart(ctx4, {
	type: "line",
	data: {
	  labels: [],
	  datasets: [{
		label: "Daya",
		tension: 0,
		borderWidth: 0,
		pointRadius: 5,
		pointBackgroundColor: "rgba(255, 255, 255, .8)",
		pointBorderColor: "transparent",
		borderColor: "rgba(255, 255, 255, .8)",
		borderColor: "rgba(255, 255, 255, .8)",
		borderWidth: 4,
		backgroundColor: "transparent",
		fill: true,
		data: [],
		maxBarThickness: 6

	  }],
	},
	options: {
	  responsive: true,
	  maintainAspectRatio: false,
	  plugins: {
		legend: {
		  display: false,
		}
	  },
	  interaction: {
		intersect: false,
		mode: 'index',
	  },
	  scales: {
		y: {
		  grid: {
			drawBorder: false,
			display: true,
			drawOnChartArea: true,
			drawTicks: false,
			borderDash: [5, 5],
			color: 'rgba(255, 255, 255, .2)'
		  },
		  ticks: {
			display: true,
			color: '#f8f9fa',
			padding: 10,
			font: {
			  size: 14,
			  weight: 300,
			  family: "Roboto",
			  style: 'normal',
			  lineHeight: 2
			},
		  }
		},
		x: {
		  grid: {
			drawBorder: false,
			display: false,
			drawOnChartArea: false,
			drawTicks: false,
			borderDash: [5, 5]
		  },
		  ticks: {
			display: true,
			color: '#f8f9fa',
			padding: 10,
			font: {
			  size: 14,
			  weight: 300,
			  family: "Roboto",
			  style: 'normal',
			  lineHeight: 2
			},
		  }
		},
	  },
	},
  });

	  function ctx4update(){
		  $.ajax({
		  url: base_url + 'sensor/get_date',
		  type: 'post',
		  dataType: 'json',
		  data: 'mac_address='+$('input#mac_address').val()+' && barang_id='+$('#barang_id').val(),
		  success: function (response) {
			  grafik_ctx4.data.labels = response.date;
			  grafik_ctx4.data.datasets[0].data = response.energy;
			  grafik_ctx4.update();
		  }
	  });
	  }
	  setInterval(ctx4update, 1000);



	  var ctx2 = document.getElementById("chart-line").getContext("2d");

	  var grafik_ctx2 = new Chart(ctx2, {
		type: "line",
		data: {
		  labels: [],
		  datasets: [{
			label: "Daya",
			tension: 0,
			borderWidth: 0,
			pointRadius: 5,
			pointBackgroundColor: "rgba(255, 255, 255, .8)",
			pointBorderColor: "transparent",
			borderColor: "rgba(255, 255, 255, .8)",
			borderColor: "rgba(255, 255, 255, .8)",
			borderWidth: 4,
			backgroundColor: "transparent",
			fill: true,
			data: [],
			maxBarThickness: 6
  
		  }],
		},
		options: {
		  responsive: true,
		  maintainAspectRatio: false,
		  plugins: {
			legend: {
			  display: false,
			}
		  },
		  interaction: {
			intersect: false,
			mode: 'index',
		  },
		  scales: {
			y: {
			  grid: {
				drawBorder: false,
				display: true,
				drawOnChartArea: true,
				drawTicks: false,
				borderDash: [5, 5],
				color: 'rgba(255, 255, 255, .2)'
			  },
			  ticks: {
				display: true,
				color: '#f8f9fa',
				padding: 10,
				font: {
				  size: 14,
				  weight: 300,
				  family: "Roboto",
				  style: 'normal',
				  lineHeight: 2
				},
			  }
			},
			x: {
			  grid: {
				drawBorder: false,
				display: false,
				drawOnChartArea: false,
				drawTicks: false,
				borderDash: [5, 5]
			  },
			  ticks: {
				display: true,
				color: '#f8f9fa',
				padding: 10,
				font: {
				  size: 14,
				  weight: 300,
				  family: "Roboto",
				  style: 'normal',
				  lineHeight: 2
				},
			  }
			},
		  },
		},
	  });
  

	  function ctx2update(){
		$.ajax({
		url: base_url + 'sensor/get_week',
		type: 'post',
		dataType: 'json',
		data: 'mac_address='+$('input#mac_address').val()+' && barang_id='+$('#barang_id').val(),
		success: function (response) {
			grafik_ctx2.data.labels = response.week;
			grafik_ctx2.data.datasets[0].data = response.energy;
			grafik_ctx2.update();
		}
	});
	}
	setInterval(ctx2update, 1000);

	
    var ctx3 = document.getElementById("chart-line-tasks").getContext("2d");

   var grafik_ctx3 = new Chart(ctx3, {
      type: "line",
      data: {
        labels: [],
        datasets: [{
          label: "Daya",
          tension: 0,
          borderWidth: 0,
          pointRadius: 5,
          pointBackgroundColor: "rgba(255, 255, 255, .8)",
          pointBorderColor: "transparent",
          borderColor: "rgba(255, 255, 255, .8)",
          borderWidth: 4,
          backgroundColor: "transparent",
          fill: true,
          data: [],
          maxBarThickness: 6

        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
              color: 'rgba(255, 255, 255, .2)'
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#f8f9fa',
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#f8f9fa',
              padding: 10,
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });

	function ctx3update(){
		$.ajax({
		url: base_url + 'sensor/get_month',
		type: 'post',
		dataType: 'json',
		data: 'mac_address='+$('input#mac_address').val()+' && barang_id='+$('#barang_id').val(),
		success: function (response) {
			grafik_ctx3.data.labels = response.month;
			grafik_ctx3.data.datasets[0].data = response.energy;
			grafik_ctx3.update();
		}
	});
	}

	setInterval(ctx3update, 1000);






 
	
	  
	
	
	  
		
	 
	  
		
		
	 

  


