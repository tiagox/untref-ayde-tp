/* global $ */

$(function() {
  'use strict';

  var costReportBaseUrl = $('a#cost_report').attr('href');

  function updateLink () {
    $('a#cost_report').attr('href',
        costReportBaseUrl + $('#cost_report_month').val());
  }

  $('#cost_report_month').change(updateLink);

  updateLink();

});
