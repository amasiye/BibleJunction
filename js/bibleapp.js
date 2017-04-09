var ep, searchlist;

$("document").ready(function() {
  ep = new Endpoint;
  searchlist = [];

  /* Newsletters */
  var nl = new Newsletter();
  nl.startSubscriptionListener();

  listenForSearch();
});

var term, answer, suggestionbox, MAX_SUGGESTIONS;
function listenForSearch()
{
  suggestionbox = $('#search-form .dropdown-autocomplete');
  MAX_SUGGESTIONS = 15;
  $('#search-form input').on('keyup', function(e) {
    term = $('#searchbar-search').val();
    var word = '';
    if(term.length > 0) {
      $.get(
        ep.base + 'app/en-US/scripts/searchlist.php',
        {},
        function(data, status) {
          answer = JSON.parse(data);
          suggestionbox.empty();
          for(var x = 0; x < MAX_SUGGESTIONS; x++) {
            suggestionbox.append('<li>' + answer[x] + '</li>');
          }
          
          if($(suggestionbox).hasClass('hidden')) {
            $(suggestionbox).removeClass('hidden');
            console.log('Hello');
          }
        }
      );
    } else {
      if(1 <= searchlist.length) {
        console.log(searchlist);
        searchlist = [];
      }
      $(suggestionbox).addClass('hidden');
    }
  });

  $('#search-form').on('submit', function(e) {
    e.preventDefault();
    e.stopPropagation();

    term = $('#searchbar-search').val();

    if(term.length > 0)
    {
      location.href = ep.search + term;
      // console.log(location.search);
    }
  });
} // end listenForSearch()

function search(term)
{

}

/**
 * Manages all subscription events and activity.
 */
function startSubscriptionListener()
{
  $("#subscribe").click(function() {
    subscribeToNewsletter($("#email").val());
  });
}

/**
 *
 */
function subscribeToNewsletter(email)
{
  var ep = {"subscription" : location.href + "api/user/subscribe/"};
  $.post(
    ep.subscription,
    {
      'email' : email
    },
    function(data) {
      // Redirect to success page or failure
      var response = JSON.parse(data);
      alert(response.status);
      // switch()
    }
  );
}

function Newsletter()
{
  this.startSubscriptionListener = startSubscriptionListener;
}

function Bible()
{

}

function Passage()
{

}

function User()
{

}

function Endpoint()
{
  this.base = (0 === location.origin.localeCompare("http://localhost"))? 
                "http://localhost/atatusoft/BibleJunction/bibleapp/" : location.origin + "/";
  this.subscribe = this.base + "api/user/subscribe/";
  this.search = this.base + "search/";
} // end Endpoint()
