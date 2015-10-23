 Dropzone.autoDiscover = false;

 var nowDate = new Date();
 var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);

 // Starting Date
 $('#datetimepicker1').datetimepicker({
     format: 'LL'
 });
 // Ending Date
 $('#datetimepicker2').datetimepicker({
     format: 'LL'
 });
 $('#datetimepicker3').datetimepicker({
     format: 'LT'
 });
 $('#datetimepicker4').datetimepicker({
     format: 'LT'
 });


 $('#datetimepicker1').data("DateTimePicker").minDate(today);
 $('#datetimepicker2').data("DateTimePicker").minDate(today);

 $("#datetimepicker1").on("dp.change", function(e) {
     $('#datetimepicker2').data("DateTimePicker").minDate(e.date);
 });
 $("#datetimepicker2").on("dp.change", function(e) {
     $('#datetimepicker1').data("DateTimePicker").maxDate(e.date);
 });
 // var myDropzone = new Dropzone("#my", {
 //    autoProcessQueue: false,
 //  uploadMultiple: true,
 //  parallelUploads: 100,
 //  maxFiles: 100,
 //     url: "/buzzcreate" ,
 //     method : "post",
 //     dictDefaultMessage: "Drop/Click to Upload Poster",
 //     addRemoveLinks: true,
 //     removedfile: function(file) {
 //         var _ref;
 //         return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
 //     },
 //     accept: function(file, done) {
 //         console.log("uploaded");
 //         done();
 //     },
 //     init: function() {
 //         this.on("addedfile", function() {
 //             if (this.files[1] != null) {
 //                 this.removeFile(this.files[0]);
 //             }
 //         });
 //     }

 // });
 // Dropzone.options.my = {
 //     dictDefaultMessage: "Drop/Click to Upload Poster",
 //     addRemoveLinks: true,
 //     removedfile: function(file) {
 //         var _ref;
 //         return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
 //     },
 //     accept: function(file, done) {
 //         console.log("uploaded");
 //         done();
 //     },
 //     init: function() {
 //         this.on("addedfile", function() {
 //             if (this.files[1] != null) {
 //                 this.removeFile(this.files[0]);
 //             }
 //         });
 //     }
 // };
