import { wait } from "assets/js/shared/util";

export function initSearch ({searchToggleId, searchContainerId, searchCloseId, searchInputId, resultContainerId, rootUrl}) {
    const $searchToggle = $('#' + searchToggleId);
    const $searchContainer = $('#' + searchContainerId);
    const $closeButton = $('#' + searchCloseId);
    const $searchInput = $('#' + searchInputId);
    const $resultContainer = $('#' + resultContainerId);

    $searchToggle.on('click', async (e) => {
        $searchContainer.toggleClass('visible');
        await wait(200);
        $searchContainer.toggleClass('open');
    });

    $closeButton.on('click', async () => {
        $searchContainer.toggleClass('visible');
        await wait(200);
        $searchContainer.toggleClass('open');
    });

    $searchInput.on('input', function () {
        let inputValue = $searchInput.val();

        // If input is empty...
        if (inputValue.length < 2) {
            // ... clear results container and send NO request
            $resultContainer.empty();
        } else {
            // handle whitespaces
            inputValue = inputValue.replace(/\s/g, "%20");
            handleAutoCompleteSearch(inputValue, $resultContainer, rootUrl);
        }
    });
}

// autocomplete search handler
function handleAutoCompleteSearch(param, resultContainer, rootUrl) {
    fetch(
        `${rootUrl}/search/autocomplete?q=${param}`,
        {
            method: 'GET',
            credentials: 'same-origin',
            headers: {
                'X-Requested-With': 'fetch'
            }
        })
        .then(res => res.json())
        .then(res => {
            handleSearchResults(res.data, resultContainer)
        })
        .catch(err => console.log(err));

    // search result handler
    function handleSearchResults(data, resultContainer) {
        // clear container
        resultContainer.empty();

        // add result data
        if (data.length > 0) {
            // build results
            for (let result of data) {
                const html = $(
                    `<a class="search-result" href="${result.url}">
                        <span class="search-result--title">${result.title}</span> <span class="search-result--type">(${result.type})</span>
                     </a>`
                );

                resultContainer.append(html);
            }
        } else {
            resultContainer.append($(`<span class="search-result">Deine Suche lieferte keine Ergebnisse.</span>`))
        }
    }
}

export function initOnPageSearch({resultContainerId, searchInputId, baseUrl}){
    // VARIABLES
    let searchTags            = [];
    let debounceTimeout       = null;
    const $resultContainer    = $('#' + resultContainerId);
    const $searchInput        = $('#' + searchInputId);
    const $tags               = $('.search_tag');

    $searchInput.on('input', function() {

       const inputValue = $(this).val();

       clearTimeout(debounceTimeout);

       debounceTimeout = setTimeout((inputValue) => {
           // If input is empty...
           if (inputValue.length < 2) {
               // ... clear results container, reset the headline and send NO request
               $resultContainer.empty();
           } else {
               handleTextSearch(inputValue, searchTags, $tags, baseUrl, $resultContainer);
           }
       }, 300, inputValue)
    });


    // EventListener for tag search inputs
    $tags.on('click', function () {

        const tagIndex = searchTags.findIndex(tag => tag === $(this).attr('data-value'));

        if (tagIndex > -1) {
            searchTags.splice(tagIndex, 1);
            $(this).removeClass('--active');
        } else {
            searchTags.push($(this).attr('data-value'));
            $(this).addClass('--active');
        }

        if (searchTags.length > 0) {
            // Search for the chosen tags
            handleTagSearch(searchTags);

        } else {
            $resultContainer.empty();
        }

    });

    // Make search input focused from begin
    $searchInput.focus();
}

// SEARCH HANDLING
function handleTextSearch(param, searchTags, $tags, baseUrl, $resultContainer) {
    $tags.each(function () {
        $(this).removeClass('--active');
    });

    fetch(
        `${baseUrl}/search/contents?q=${param}`,
        {
            method: 'GET',
            credentials: 'same-origin',
            headers: {
                'X-Requested-With': 'fetch'
            }
        }
    )
        .then(res => res.json())
        .then(res => {
            handleOnPageSearchResults(res.data, $resultContainer)
        })
        .catch(err => console.log(err));
}


function handleTagSearch(tags, $searchInput, $resultContainer) {
    $searchInput.val('');

    fetch(
        `${baseUrl}/search/tags`,
        {
            method: 'POST',
            body: JSON.stringify({tags: tags}),
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'fetch'
            }
        }
    )
        .then(res => res.json())
        .then(res => {
            handleOnPageSearchResults(res.data, $resultContainer)
        })
        .catch(error => console.log(error));
}

function handleOnPageSearchResults(data, $resultContainer) {
    // clear container
    $resultContainer.html('');

    // add result data
    if (data.length > 0) {
        // build results
        for (let result of data) {

            const template =
                `<article class="col-md-3 ws-card">
                    <a href="${result.url}">
                        <figure class="ws-bg-img ws-img--square scale"
                                style="background-image: url(${result.thumbUrl})"></figure>
                        <section class="ws-card--detail ws-bg-light-gray">
                            <h2 class="ws-card--title">${result.title}</h2>
                            <p class="ws-card--subtitle">${result.type}</p>
                        </section>
                    </a>
                </article>`;

            $resultContainer.append($(template));
        }
    } else {
        $resultContainer.append($(`<p>Deine Suche lieferte keine Ergebnisse.</p>`))
    }
}



