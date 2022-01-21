// const search = $('.med-name').val()
const matchList = document.getElementById('search_result');
 
async function searchState(searchText) {
    if(searchText === 0) {
        match = [];
    }
    const res = await fetch('/js/med.json');
    const states = await res.json();

    // Get matche to current text input
    let match = states.filter(state => {
        const regEx = new RegExp(`^${searchText}`, 'gi');
        return state.name.match(regEx) || state.composition.match(regEx);
    });

    const slice_array = match.slice(0, 20);
 
    const html = slice_array.map(mat => ` 
            <li>
                <small class="text-primary">${mat.name}</small> 
            </li>  
    `).join('');

    matchList.innerHTML = html; 

    console.log(slice_array);
}
 
$(document).on('keyup', '.med-name', function() {
    const searchText = $(this).val();    
    searchState(searchText); 
})

$(window).on('click')