<script src="<?php echo base_url('package/assets/libs/jquery/dist/jquery.min.js')?>"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="<?php echo base_url('package/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')?>"></script>
<!-- Theme Required Js -->
<script src="<?php echo base_url('package/dist/js/app.min.js')?>"></script>
<script src="<?php echo base_url('package/dist/js/app.init.js')?>"></script>
<script src="<?php echo base_url('package/dist/js/app-style-switcher.js')?>"></script>
<!-- perfect scrollbar JavaScript -->
<script src="<?php echo base_url('package/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')?>">
</script>
<script src="<?php echo base_url('package/assets/extra-libs/sparkline/sparkline.js')?>"></script>
<!--Wave Effects -->
<script src="<?php echo base_url('package/dist/js/waves.js')?>"></script>
<!--Menu sidebar -->
<script src="<?php echo base_url('package/dist/js/sidebarmenu.js')?>"></script>
<!--Custom JavaScript -->
<script src="<?php echo base_url('package/dist/js/feather.min.js')?>"></script>
<script src="<?php echo base_url('package/dist/js/custom.min.js')?>"></script>
<!-- Datatables JS -->
<script src="<?php echo base_url('package/assets/Datatables/datatables.min.js')?>"></script>
<!-- <script src="<?php echo base_url('package/assets/Datatables/Responsive-2.3.1/css/responsive.bootstrap5.min.js')?>"></script> -->
<!-- Datatables CSS -->
<link href="<?php echo base_url('package/assets/Datatables/datatables.min.css')?>" rel="stylesheet">
</link>
<!-- <link href="<?php echo base_url('package/assets/Datatables/Responsive-2.3.1/css/responsive.bootstrap5.min.css')?>" rel="stylesheet"></link> -->
<script src="<?php echo base_url('package/ckeditor/ckeditor.js'); ?>"></script>

<script src="<?php echo base_url('package/chart/code/highcharts.js'); ?>"></script>
<script src="<?php echo base_url('package/chart/code/modules/series-label.js'); ?>"></script>
<script src="<?php echo base_url('package/chart/code/modules/exporting.js'); ?>"></script>
<script src="<?php echo base_url('package/chart/code/modules/export-data.js'); ?>"></script>
<script src="<?php echo base_url('package/chart/code/modules/accessibility.js'); ?>"></script>
<!-- Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
    $('.select2').select2({
        // theme: "bootstrap-5"
    });
  });

  $(function () {
    //CKEditor
    CKEDITOR.replace('ckeditor');
    CKEDITOR.config.height = 300;

    //TinyMCE
    tinymce.init({
        selector: "textarea#tinymce",
        theme: "modern",
        height: 300,
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        image_advtab: true
    });
    tinymce.suffix = ".min";
    tinyMCE.baseURL = '../../plugins/tinymce';
});
</script>
<script>
    const formatRupiah = (money) => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(money);
    }
</script>