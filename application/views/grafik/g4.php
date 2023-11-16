<div>
<canvas height="" id="g4"></canvas>
</div>
 <?php $this->load->view('style/link_grafik') ?>
<script>
var g4 = document.getElementById('g4').getContext('2d');
var chart = new Chart(g4, {
    type: 'pie',
    data: {
        labels: [
            <?php
            if (count($graph)>0) {
              foreach ($graph as $data) {
                echo "'" .$data->nama_produk ."',";
              }
            }
          ?>
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