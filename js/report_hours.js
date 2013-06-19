/* global $, bootbox */

$(function() {
  'use strict';

  var userData = {};

  function fetchUserData () {
    var userId = $('.user').val();

    $.ajax({
      url: '/report_hours/get_user_data',
      type: 'POST',
      data: {'user_id': userId},
      dataType: 'json',
      success: function (response) {
        userData = response;

        markReportedWeeks();
        checkIfWeekWasReported();
      }
    });
  }

  function markReportedWeeks () {
    var reportedHours = 0,
        i = 0,
        j = 0,
        $option,
        text;

    if (userData && userData.weeks) {
      for (i in userData.weeks) {
        if (userData.weeks[i] && userData.weeks[i].projects) {
          for (j in userData.weeks[i].projects) {
            reportedHours += 1 * userData.weeks[i].projects[j];
          }

          if (reportedHours > 0) {
            $option = $($('.week option[value=' + i + ']').get(0));
            text = $option.html() + ' &#10004;';
            $option.html(text);
          }
        }
      }
    }
  }

  function checkIfWeekWasReported () {
    var weekId = $('.week').val(),
        selectedWeek = $($('.week option').filter(':selected').get(0)).html(),
        reportedHours = 0,
        i = 0;

    if (userData && userData.weeks && userData.weeks[weekId] && userData.weeks[weekId].projects) {
      for (i in userData.weeks[weekId].projects) {
        reportedHours += 1 * userData.weeks[weekId].projects[i];
      }
    }

    loadReportedHours();

    if (reportedHours > 0) {
      showAlert('Ya fueron reportadas las horas para la <strong>' + selectedWeek + '</strong>');
    } else {
      clearAlert();
    }

    updateCounter();
  }

  function loadReportedHours () {
    var weekId = $('.week').val(),
        i = 0;

    $('input.project').each(function (i, project) {
      $(project).val(0);
    });

    if (userData && userData.weeks && userData.weeks[weekId] && userData.weeks[weekId].projects) {
      for (i in userData.weeks[weekId].projects) {
        var $currentProject = $('input#project_' + i);

        if ($currentProject) {
          $currentProject.val(1 * userData.weeks[weekId].projects[i]);
        }
      }
    }
  }

  function updateCounter () {
    var $projects = $('.project'),
        accumulatedHours = 0;

    $projects.each(function (i, project) {
      accumulatedHours += 1 * $(project).val();
    });

    userData.weeklyHours = userData.weeklyHours || 40;

    $('#weekly_hours').html(userData.weeklyHours);

    $('#hours_count').html(accumulatedHours)
        .attr('class', getLabelType(accumulatedHours, userData.weeklyHours));
  }

  function validateFormBeforeSend () {
    if (getLoadedHours() < userData.weeklyHours) {
      var  message = '<p>Va a reportar menos horas de las que corresponden a' +
          ' una semana.</p><p><strong>¿Esta seguro que desea continuar con' +
          ' esta acción?</strong></p>';

      bootbox.confirm(message, function(ok) {
        if (ok) {
          $($('form').get(0)).submit();
        }
      });

      return false;
    }
  }

  function getLabelType (acumulated, weeklyHours) {
    var label = 'label label-success';

    if (acumulated < weeklyHours) {
      label = 'label label-important';
    } else if (acumulated > weeklyHours) {
      label = 'label label-warning';
    }

    return label;
  }

  function showAlert (message) {
    var $closeButton = $(document.createElement('div')).attr({
        'type': 'button',
        'class': 'close',
        'data-dismiss': 'alert'
      }).html('&times;'),
      $alert = $(document.createElement('div')).attr({
        'class': 'alert'
      });

    $alert.append($closeButton);
    $alert.append(message);

    clearAlert();

    $('.messages').append($alert);
  }

  function clearAlert () {
    $('.messages').html('');
  }

  $('.user').bind('change', fetchUserData);
  $('.week').bind('change', checkIfWeekWasReported);
  $('.project').bind('keyup change', updateCounter);
  $('#save_hours').bind('click', validateFormBeforeSend);

  fetchUserData();
  checkIfWeekWasReported();
  updateCounter();

});
