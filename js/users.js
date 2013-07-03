/* global $, bootbox */

$(function() {
  'use strict';

  function confirmDeletion (event) {
    var href = $(event.currentTarget).attr('href'),
        message = '<p>¿Esta seguro que desea borrar este usuario?</p>';

    bootbox.confirm(message, function(ok) {
      if (ok) {
        window.location = href;
      }
    });

    return false;
  }

  $('.delete-user').bind('click', confirmDeletion);

});
