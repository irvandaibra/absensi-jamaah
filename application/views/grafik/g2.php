<div>
<canvas height="85" id="g2"></canvas>
</div>
 <?php $this->load->view('style/link_grafik') ?>
<script>
var g2 = document.getElementById('g2').getContext('2d');
var chart = new Chart(g2, {
    type: 'bar',
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