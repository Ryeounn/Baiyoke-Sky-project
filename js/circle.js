const ctx2 = document.getElementById('quantity');

  new Chart(ctx2, {
    type: 'doughnut',
    data: {
      labels: ['18', '75', '76-78', '79', '81'],
      datasets: [{
        label: 'Ticket Quantity',
        data: [1000, 6000, 3000, 6000, 15000]
      }]
    }
    
  });

const ctx3 = document.getElementById('sold');

  new Chart(ctx3, {
    type: 'doughnut',
    data: {
      labels: ['18', '75', '76-78', '79', '81'],
      datasets: [{
        label: 'Ticket Sold Out',
        data: [514, 1120, 2278, 1290, 3126]
      }]
    }
  });


  const ctx4 = document.getElementById('inven');

  new Chart(ctx4, {
    type: 'doughnut',
    data: {
      labels: ['18', '75', '76-78', '79', '81'],
      datasets: [{
        label: 'Ticket Inventory',
        data: [486, 4880, 722, 4710, 11874]
      }]
    }
  });



