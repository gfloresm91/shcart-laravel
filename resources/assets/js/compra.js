Stripe.setPublishableKey('pk_test_LL88wrlWh2EmjSvK5aWV6GMW');

$(function() {
  var $form = $('#checkout-form');
  $form.submit(function(event) {
    $('#checkout-errors').addClass('hidden');
    // Disable the submit button to prevent repeated clicks:
    $form.find('button').prop('disabled', true);

    // Request a token from Stripe:
    Stripe.card.createToken($form, stripeResponseHandler);

    // Prevent the form from being submitted:
    return false;
  });
});

function stripeResponseHandler(status, response) {
  // Grab the form:
  var $form = $('#checkout-form');

  if (response.error) { // Problem!
    $('#checkout-errors').removeClass('hidden');
    // Show the errors on the form:
    $('#checkout-errors').text(response.error.message);
    $form.find('button').prop('disabled', false); // Re-enable submission

  } else { // Token was created!

    // Get the token ID:
    var token = response.id;

    // Insert the token ID into the form so it gets submitted to the server:
    $form.append($('<input type="hidden" name="stripeToken">').val(token));

    // Submit the form:
    $form.get(0).submit();
  }
};