const ctx = document.getElementById('revenue');

  new Chart(ctx, {
    type: 'radar',
    data: {
      labels: ['Floor 18', 'Floor 75', 'Floor 76-78', 'Floor 79', 'Floor 81'],
      datasets: [{
        label: 'Revenue',
        data: [128500, 877000, 2102900, 1288000, 3993300],
        borderWidth: 1
      }]
    },
  });

const ctx2 = document.getElementById('quantity');

  new Chart(ctx2, {
    type: 'polarArea',
    data: {
      labels: ['18', '75', '76-78', '79', '81'],
      datasets: [{
        label: 'Ticket Quantity',
        data: [1000, 6000, 3000, 6000, 15000],
      }]
    },
    
  });
