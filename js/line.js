const ctx = document.getElementById('user');

  new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['First Quarter', 'Second Quarter', 'Third Quarter', 'Fourth Quarter'],
      datasets: [{
        label: 'User',
        data: [2, 5, 17, 22],
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
  
  const ctx2 = document.getElementById('date');

  new Chart(ctx2, {
    type: 'line',
    data: {
      labels: ['30/8', '31/8', '1/9', '2/9'],
      datasets: [{
        label: 'Date',
        data: [2, 4, 9, 22],
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


