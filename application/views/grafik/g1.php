 <div>
<canvas height=187 id="g1"></canvas>
</div>
 <?php $this->load->view('style/link_grafik') ?>
<script>
  var g1 = document.getElementById('g1').getContext('2d');
  var chart = new Chart(g1, {
      type: 'bar',
      data: {
          labels: [
              <?php
              if (count($graph)>0) {
                foreach ($graph as $data) {
                  echo "'" .$data->id_toko ."',";
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