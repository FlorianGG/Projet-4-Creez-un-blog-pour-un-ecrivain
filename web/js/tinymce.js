tinymce.init({
  selector: "#tinyMCE1",
  height: 300,
  plugins: [
    "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak",
    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
    "table contextmenu directionality emoticons template textcolor paste textcolor colorpicker textpattern"
  ],

  toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify |cut copy paste | searchreplace |  formatselect fontselect", 
  toolbar2: "fontsizeselect | forecolor backcolor | hr removeformat |",
  toolbar3: " bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | subscript superscript | charmap emoticons",
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//fonts.googleapis.com/css?family=Lora:400,700',
    '//www.tinymce.com/css/codepen.min.css'],

  menubar: false,
  toolbar_items_size: 'small',
});
