require(
    [
        'jquery',
        'mage/translate',
        'Magento_Ui/js/modal/modal'
    ],
    function( $, $t, modal ) {
      var options = {
          type: 'popup',
          modalClass: 'confirm',
          responsive: true,
          innerScroll: true,
          buttons: [{
              text: $.mage.__('Cancel'),
              class: 'action-secondary action-dismiss',
              click: function () {
                  this.closeModal();
              }
            },
            {
              text: $.mage.__('Continue'),
              class: 'action-primary action-accept',
              click: function () {
                  var action = this.focussedElement.getAttribute("data-action");
                  window.location.href = action;
                  this.closeModal();
              }
            }]
      };
      var popup = modal(options, '<div id="popup-modal">'+ $t('¿Are you sure you want to remove this order from history?')+'</div>');
      $('.remove-order').click(function(e){
        e.preventDefault();
        $('#popup-modal').modal('openModal');
      });
});
