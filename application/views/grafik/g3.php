<div>
<canvas height="" id="g3"></canvas>
</div>
 <?php $this->load->view('style/link_grafik') ?>
<script>
var g3 = document.getElementById('g3').getContext('2d');
var chart = new Chart(g3, {
    type: 'pie',
    data: {
        labels: [
           
        ],
        datasets: [{
            label: 'Harga Jual',
            backgroundColor: '#ADD8E6',
            borderColor: '##93C3D2',
            data: [
                <?php
                if (count($graph)>0) {
                   foreach ($graph as $data) {
                    echo $data->harga_jual . ", ";
                  }
                }
              ?>
            ]
        }]
    },
});
</script>