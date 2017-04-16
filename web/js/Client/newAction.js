
var $collectionHolder;

// setup an "add a Phonenumber" link
var $addPhonenumberLink = $('<a href="#" class="add_phonenumber_link">Add a phone</a>');
var $newLinkLi = $('<li></li>').append($addPhonenumberLink);

jQuery(document).ready(function() {
    // Get the ul that holds the collection of Phonenumbers
    $collectionHolder = $('ul.phonenumbers');
    
    // add a delete link to all of the existing  form li elements
    $collectionHolder.find('li').each(function() {
        addPhonenumberFormDeleteLink($(this));
    });

    // add the "add a phonenumber" anchor and li to the phonenumbers ul
    $collectionHolder.append($newLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addPhonenumberLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new phonenumber form (see next code block)
        addPhonenumberForm($collectionHolder, $newLinkLi);
    });
    
    function addPhonenumberForm($collectionHolder, $newLinkLi) {
        // Get the data-prototype explained earlier
        var prototype = $collectionHolder.data('prototype');

        // get the new index
        var index = $collectionHolder.data('index');

        // Replace '__name__' in the prototype's HTML to
        // instead be a number based on how many items we have
        var newForm = prototype.replace(/__name__/g, index);

        // increase the index with one for the next item
        $collectionHolder.data('index', index + 1);

        // Display the form in the page in an li, before the "Add a phonenumber" link li
        var $newFormLi = $('<li></li>').append(newForm);
        $newLinkLi.before($newFormLi);
        
        // add a delete link to the new form
        addPhonenumberFormDeleteLink($newFormLi);
    }
    
    function addPhonenumberFormDeleteLink($newFormLi) {
        var $removeFormA = $('<a href="#">delete this phone</a>');
        $newFormLi.append($removeFormA);

        $removeFormA.on('click', function(e) {
            // prevent the link from creating a "#" on the URL
            e.preventDefault();

            // remove the li for the tag form
            $newFormLi.remove();
        });
    }
});