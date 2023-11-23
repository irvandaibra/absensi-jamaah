 <div>
     <canvas height=187 id="g1"></canvas>
 </div>
 <?php $this->load->view('style/link_grafik') ?>
 <script>
var g1 = document.getElementById('g1').getContext('2d');
var chart = new Chart(g1, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Harga Jual',
            backgroundColor: '#ADD8E6',
            borderColor: '##93C3D2',
            data: [65, 59, 80, 81, 56, 55, 40],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)'
            ],
            borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
            ],
            borderWidth: 1
        }]
    },
});
 </script>