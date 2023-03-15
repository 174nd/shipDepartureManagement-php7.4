$(function () {  
  $(document).ready(function () {
    bsCustomFileInput.init();

    $("form").submit(function (e) {
      $(":disabled").each(function (e) {
        $(this).css("background-color", "#e9ecef");
        $(this).removeAttr("disabled");
      });
    });

    $(document).on("hidden.bs.modal", function (e) {
      if ($(".modal").hasClass("show")) {
        $("body").addClass("modal-open");
      }
    });

    $(document).on("show.bs.modal", ".modal", function () {
      var zIndex = 1040 + 10 * $(".modal:visible").length;
      $(this).css("z-index", zIndex);
      setTimeout(function () {
        $(".modal-backdrop")
          .not(".modal-stack")
          .css("z-index", zIndex - 1)
          .addClass("modal-stack");
      }, 0);
    });

    $(".select2").select2({
      width: "100%",
      theme: 'bootstrap4',
    });

    $(".myclockpicker").clockpicker({
      placement: "top",
      align: "left",
      autoclose: true,
      default: "now",
    });

    $(".myclockbpicker").clockpicker({
      placement: "bottom",
      align: "left",
      autoclose: true,
      default: "now",
    });

    $(".myclocklpicker").clockpicker({
      placement: "top",
      align: "left",
      autoclose: true,
      default: "now",
    });

    $(".myclockrpicker").clockpicker({
      placement: "top",
      align: "right",
      autoclose: true,
      default: "now",
    });

    $(".mydatepicker").datepicker({
      autoclose: true,
      format: "yyyy-mm-dd",
      endDate: Infinity,
      orientation: "bottom",
    });

    var currentDate = new Date();
    const monthNames = [
      "January",
      "February",
      "March",
      "April",
      "May",
      "June",
      "July",
      "August",
      "September",
      "October",
      "November",
      "December",
    ];
    const monthNamesShort = [
      "Jan",
      "Feb",
      "Mar",
      "Apr",
      "May",
      "Jun",
      "Jul",
      "Aug",
      "Sep",
      "Oct",
      "Nov",
      "Dec",
    ];
    $(".mymonthpicker")
      .datepicker({
        autoclose: true,
        useCurrent: true,
        format: "MM yyyy",
        viewMode: "months",
        minViewMode: "months",
        endDate: Infinity,
        orientation: "bottom",
      })
      .val(
        monthNames[currentDate.getMonth()] + " " + currentDate.getFullYear()
      );

    $(".mymonthsnpicker")
      .datepicker({
        autoclose: true,
        useCurrent: true,
        format: "M yyyy",
        viewMode: "months",
        minViewMode: "months",
        endDate: Infinity,
        orientation: "bottom",
      })
      .val(
        monthNamesShort[currentDate.getMonth()] +
        " " +
        currentDate.getFullYear()
      );

    $(".myyearpicker").datepicker({
      autoclose: true,
      useCurrent: true,
      format: "yyyy",
      viewMode: "years",
      minViewMode: "years",
      endDate: Infinity,
      orientation: "bottom",
    });

    
  $('.connectedSortable').sortable({
    placeholder         : 'sort-highlight',
    connectWith         : '.connectedSortable',
    handle              : '.card-header, .nav-tabs',
    forcePlaceholderSize: true,
    zIndex              : 999999
  })
  $('.connectedSortable .card-header, .connectedSortable .nav-tabs-custom').css('cursor', 'move');
  });
});