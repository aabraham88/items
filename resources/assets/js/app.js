import './bootstrap';
import ItemCRUD from './ItemCrud';

const crudStatus = {
  created: 'created',
  edited: 'edited',
};

$(document).ready(() => {
  $.get('/api/v1/items')
    .done(function(response) {
        ItemCRUD.loadItems(response.data);
    })
    .fail(function() {
      $( '.ajax-response' )
        .addClass('text-danger')
        .html('Hubo un error :(');
    });

  $('form').on('submit', (e) => {
    e.preventDefault();
    console.log('form submited');
  })
});

$(document).on('show.bs.modal', '.modal', function () {
  const wrapper = $('.generalMessageWrapper');
  if(wrapper.css('display') === 'block') {
    wrapper.toggle();
  }
});

$(document).on('hide.bs.modal', ['#editModal', '#createModal'], function () {
  const modal = $('.modal');

  $('.warningWrapper').hide();

  modal.find('img').attr('src', '');
  modal.find('input[type=file]').val('');
  modal.find('input.description').val('');
  modal.find('.alert-warning > p').text('');
});

window.deleteItem = (me) => {
  const id = me.getAttribute('data-id');

  $.ajax({
    type: "DELETE",
    url: `/api/v1/items/${id}`,
    success: (data) => {
      $('#deleteModal').modal('hide');
      $(`#item_${id}`).remove();
      ItemCRUD.removeItem(id);
    }
  });
};

window.populateModal = (itemId) => {
  const modal = $('#editModal');

  $.get('/api/v1/items/' + itemId)
    .done(function(response) {
      modal.find('img').attr('src', `/api/v1/items/${response.data.id}/image`);
      modal.find('input.description').val(response.data.description);
    })
};

window.createItem = () => {
  const modal = $('#createModal');

  let imageFile = $('#newImageFile');
  let description = $('#new-description');
  let formData = new FormData($('#createModal'));
  formData.append('imageFile', imageFile[0].files[0]);
  formData.append('description', description.val());

  $.ajax({
      type:'POST',
      url: '/api/v1/items/',
      data: formData,
      processData: false,
      contentType: false,
      success: function(response) {
          successed(crudStatus.created);
          ItemCRUD.addItemToList(response.data);
          modal.modal('hide');
      },
      error: (jqXHR) => {
        const errors = Object.values(jqXHR.responseJSON.errors).join('\n');
        $('.warningWrapper').toggle();
        $('#createErrors').text(errors);
      },
  });
};

window.successed = (action) => {
  let message = 'Item ';

  if (action === crudStatus.created) {
    message = message + 'created ';
  }

  if (action === crudStatus.edited) {
    message = message + 'edited ';
  }

  message = message + 'successfuly';

  $('.generalMessageWrapper').toggle();
  $('.generalMessageWrapper p').text(`${message}`);
};

window.editItem = () => {
  const modal = $('#editModal');
  const id = modal.attr('data-id');
  let item = $(`#item_${id}`);

  let formData = new FormData();
  let imageFile = $('#imageFile');
  let description = $('#description');
  let method = $("input[name='_method']");

  if (imageFile.val()) {
    formData.append('imageFile', imageFile[0].files[0]);
  }

  formData.append('description', description.val());
  formData.append('_method', method.val());

  $.ajax({
    type:'POST',
    url: `/api/v1/items/${id}`,
    data: formData,
    processData: false,
    contentType: false,
    success: (response) => {
      successed(crudStatus.edited);
      refreshItem(id, item);
      modal.modal('hide');
    },
    error: (jqXHR) => {
      const errors = Object.values(jqXHR.responseJSON.errors).join('\n');
      $('.warningWrapper').toggle();
      $('#editErrors').text(errors);
    },
  });
};

function refreshItem(id, item) {
    $.get('/api/v1/items/' + id)
        .done( function (response) {
            item.find('img').attr('src', response.data.image_link);
            item.find('p').text(response.data.description);
        }
    );
}

window.readURL = (input, imageHolder) => {
    if (input.files && input.files[0]) {
        let reader = new FileReader();

        reader.onload = function (e) {
            $(`#${imageHolder}`)
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

window.findObjectByKey = function(array, key, value) {
    for (let i = 0; i < array.length; i++) {
        if (array[i][key] === value) {
            return {
                'obj': array[i],
                'index': i
            };
        }
    }
    return null;
}

$('.list-group').sortable({ stop: ItemCRUD.sort });