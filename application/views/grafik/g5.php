<div>
<canvas id="g5"></canvas>
</div>
 <?php $this->load->view('style/link_grafik') ?>
<script>
var g5 = document.getElementById('g5').getContext('2d');
var chart = new Chart(g5, {
    type: 'bar',
    data: {
        labels: [
            <?php
              if (count($graph)>0) {
                foreach ($graph as $data) {
                  echo "'" .$data->id_kategori ."',";
                }
              }
            ?>
        ],
        datasets: [{
            label: 'Jumlah Terjual',
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