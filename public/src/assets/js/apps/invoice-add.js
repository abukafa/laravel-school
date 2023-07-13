function deleteItemRow() {
    deleteItem = document.querySelectorAll('.delete-item');
    for (var i = 0; i < deleteItem.length; i++) {
        deleteItem[i].addEventListener('click', function() {
            this.parentElement.parentNode.parentNode.parentNode.remove();
        })
    }
}

document.getElementsByClassName('additem')[0].addEventListener('click', function() {
  console.log('dfdf')

  getTableElement = document.querySelector('.item-table');
  currentIndex = getTableElement.rows.length;

  $html = '<tr>'+
  '<td class="delete-item-row">'+
      '<ul class="table-controls">'+
          '<li><a href="javascript:void(0);" class="delete-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle mt-2"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></a></li>'+
      '</ul>'+
    '</td>'+
    '<td class="description"><input type="text" class="form-control  form-control-sm" placeholder="Item Description"> <textarea class="form-control" placeholder="Additional Details"></textarea></td>'+
    '<td class="rate">'+
        '<input type="text" class="form-control  form-control-sm" placeholder="Price">'+
   ' </td>'+
    '<td class="text-right qty"><input type="text" class="form-control  form-control-sm" placeholder="Quantity"></td>'+
    '<td class="text-right amount"><span class="editable-amount"><span class="currency">$</span> <span class="amount">0.00</span></td>'+
    '<td class="text-center tax">'+
        '<div class="n-chk">'+
            '<div class="form-check form-check-primary form-check-inline me-0 mb-0">'+
                '<input class="form-check-input inbox-chkbox contact-chkbox" type="checkbox">'+
            '</div>'+
        '</div>'+
    '</td>'+
    '</tr>';

  $(".item-table tbody").append($html);
  deleteItemRow();

})

deleteItemRow();