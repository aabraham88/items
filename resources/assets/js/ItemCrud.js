export default {
  items: [],

  loadItems: function (data) {
    data.forEach((item) => {
      this.addItemToList(item);
    });
  },

  addItemToList: function (item) {
    let listItem = $(`<div id="item_${item.id}"></div>`);
    listItem.addClass('list-group-item list-group-item-action flex-column align-items-start');

    let paragraph = $('<p>' + item.description + '</p>', {'class': 'mb-1'});
    let inputId = $('<input type="hidden">').val(item.id);
    let img = this.loadImage(item.id);
    listItem.append(img);
    listItem.append(inputId);
    listItem.append($(paragraph));
    listItem.append(this.addButtons(item.id));

    $('.list-group').append(listItem);
    this.items.push(item);
    this.updateCounter();
  },

  loadImage: function (itemId) {
    const image = document.createElement('img');
    image.src = '/api/v1/items/' + itemId + '/image';
    image.className = 'image-responsive';
    image.style.cssText = 'height: 100px';

    return image;
  },

  addButtons: function (itemId) {
    const actionBar = document.createElement('div');

    const editButton = document.createElement('button');
    const editIcon = document.createElement('i');
    const editLabel = document.createElement('strong');

    const deleteButton = document.createElement('button');
    const deleteIcon = document.createElement('i');
    const deleteLabel = document.createElement('strong');

    editIcon.className = 'fa fa-edit';
    editButton.className = 'btn btn-primary';

    editButton.setAttribute('data-toggle', 'modal');
    editButton.setAttribute('data-target', '#editModal');
    editButton.setAttribute('data-id', itemId);

    deleteIcon.className = 'fa fa-trash';
    deleteButton.className = 'btn btn-danger';

    deleteButton.setAttribute('data-toggle', 'modal');
    deleteButton.setAttribute('data-target', '#deleteModal');
    deleteButton.type = 'button';

    deleteLabel.textContent = 'Delete';
    editLabel.textContent = 'Edit';

    editButton.appendChild(editIcon);
    editButton.appendChild(editLabel);

    deleteButton.appendChild(deleteIcon);
    deleteButton.appendChild(deleteLabel);

    actionBar.appendChild(deleteButton);
    actionBar.appendChild(editButton);

    deleteButton.onclick = (() => {
      document.getElementById('confirmDelete').setAttribute('data-id', itemId)
    });
    editButton.onclick = (() => {
      document.getElementById('editModal').setAttribute('data-id', itemId);
      populateModal(itemId);
    });

    return actionBar;
  },

  updateCounter: function () {
    $('#counter').find('span').text(this.items.length);
  },

  removeItem: function (id) {
    let data = findObjectByKey(this.items, 'id', id);
    this.items.splice(data.index, 1);
    this.updateCounter();
  },

  sort: function (event, ui) {
    let items = $('.list-group').sortable('toArray');
    let data = items.map(function (item) {
      return item.replace('item_', '');
    });

    data = JSON.stringify(data);
    let formData = new FormData();
    formData.append('items', data);
    $.ajax({
      type: 'POST',
      url: '/api/v1/items/sort',
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        //mensaje popup de ok
      },
      error: function (response) {
        alert(`Oops! ${response.message}`);
      }
    });
  }
};
