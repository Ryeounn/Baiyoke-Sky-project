const ctx = document.getElementById('ticket');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Floor 18', 'Floor 75', 'Floor 76-78', 'Floor 79', 'Floor 81'],
      datasets: [{
        label: 'Ticket Sold Out',
        data: [514, 1120, 2278, 1290, 3126],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
  
  
  const ctx1 = document.getElementById('can');
  new Chart(ctx1, {
    type: 'bar',
    data: {
      labels: ['Floor 18', 'Floor 75', 'Floor 76-78', 'Floor 79', 'Floor 81'],
      datasets: [{
        label: 'Revenue',
        data: [128500, 877000, 2102900, 1288000, 3993300],
        borderWidth: 1,
        backgroundColor: "red"
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
  
  
  




