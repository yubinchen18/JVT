
var $phonenumberCollectionHolder;
var $emailCollectionHolder;

// setup an "add a Phonenumber" link
var $addPhonenumberLink = $('<li><a href="#" class="add_phonenumber_link">Add a phone</a></li>');
var $newPhonenumberLinkLi = $('<ul class="phoneUl"></ul>').append($addPhonenumberLink);

// setup an "add a Email" link
var $addEmailLink = $('<li><a href="#" class="add_email_link">Add an email</a></li>');
var $newEmailLinkLi = $('<ul class="emailUl"></ul>').append($addEmailLink);

jQuery(document).ready(function() {
    /*
     * Phonenumber Block
     */
    // Get the ul that holds the collection of Phonenumbers
    $phonenumberCollectionHolder = $('.phonenumbers');
    
    // add a delete link to all of the existing  form li elements
    $phonenumberCollectionHolder.find('.phoneUl').each(function() {
        addPhonenumberFormDeleteLink($(this));
    });

    // add the "add a phonenumber" anchor and li to the phonenumbers ul
    $phonenumberCollectionHolder.append($newPhonenumberLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $phonenumberCollectionHolder.data('index', $phonenumberCollectionHolder.find(':input').length);

    $addPhonenumberLink.children('a').on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new phonenumber form (see next code block)
        addPhonenumberForm($phonenumberCollectionHolder, $newPhonenumberLinkLi);
    });
    
    function addPhonenumberForm($phonenumberCollectionHolder, $newLinkLi) {
        // Get the data-prototype explained earlier
        var prototypeTypeLabel = $phonenumberCollectionHolder.data('prototype-typelabel');
        var prototypeDigits = $phonenumberCollectionHolder.data('prototype-digits');
        // get the new index
        var index = $phonenumberCollectionHolder.data('index');

        // Replace '__name__' in the prototype's HTML to
        // instead be a number based on how many items we have
        var newFormTypeLabel = $('<li></li>').append(prototypeTypeLabel.replace(/__name__/g, index));
        var newFormDigits = $('<li></li>').append(prototypeDigits.replace(/__name__/g, index));
        // increase the index with one for the next item
        $phonenumberCollectionHolder.data('index', index + 1);

        // Display the form in the page in an li, before the "Add a phonenumber" link li
        var $newFormUl = $('<ul class="phoneUl"></ul>').append(newFormTypeLabel).append(newFormDigits);
        $newLinkLi.before($newFormUl);
        
        // add a delete link to the new form
        addPhonenumberFormDeleteLink($newFormUl);
    }
    
    function addPhonenumberFormDeleteLink($newFormUl) {
        var $removeFormA = $('<a href="#">delete this phone</a>');
        $newFormUl.append($removeFormA);

        $removeFormA.on('click', function(e) {
            // prevent the link from creating a "#" on the URL
            e.preventDefault();

            // remove the li for the tag form
            $newFormUl.remove();
        });
    }
    
    /**
     * Email Block
     */
    // Get the ul that holds the collection of Emails
    $emailCollectionHolder = $('.emails');
    
    // add a delete link to all of the existing  form li elements
    $emailCollectionHolder.find('.emailUl').each(function() {
        addEmailFormDeleteLink($(this));
    });

    // add the "add a email" anchor and li to the emails ul
    $emailCollectionHolder.append($newEmailLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $emailCollectionHolder.data('index', $emailCollectionHolder.find(':input').length);

    $addEmailLink.children('a').on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new email form (see next code block)
        addEmailForm($emailCollectionHolder, $newEmailLinkLi);
    });
    
    function addEmailForm($emailCollectionHolder, $newLinkLi) {
        // Get the data-prototype explained earlier
        var prototypeTypeLabel = $emailCollectionHolder.data('prototype-typelabel');
        var prototypeAddress = $emailCollectionHolder.data('prototype-address');
        // get the new index
        var index = $emailCollectionHolder.data('index');

        // Replace '__name__' in the prototype's HTML to
        // instead be a number based on how many items we have
        var newFormTypeLabel = $('<li></li>').append(prototypeTypeLabel.replace(/__name__/g, index));
        var newFormAddress = $('<li></li>').append(prototypeAddress.replace(/__name__/g, index));
        // increase the index with one for the next item
        $emailCollectionHolder.data('index', index + 1);

        // Display the form in the page in an li, before the "Add a email" link li
        var $newFormUl = $('<ul class="emailUl"></ul>').append(newFormTypeLabel).append(newFormAddress);
        $newLinkLi.before($newFormUl);
        
        // add a delete link to the new form
        addEmailFormDeleteLink($newFormUl);
    }
    
    function addEmailFormDeleteLink($newFormUl) {
        var $removeFormA = $('<a href="#">delete this email</a>');
        $newFormUl.append($removeFormA);

        $removeFormA.on('click', function(e) {
            // prevent the link from creating a "#" on the URL
            e.preventDefault();

            // remove the li for the tag form
            $newFormUl.remove();
        });
    }
});
