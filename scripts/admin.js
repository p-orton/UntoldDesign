var adjustment;

$("ol.simple_with_animation").sortable({
  group: 'simple_with_animation',
  pullPlaceholder: false,
  cursorAt: { top: 0, left: 0 }, 
  // animation on drop
  onDrop: function  ($item, container, _super) {
    var $clonedItem = $('<li/>').css({height: 0});
    $item.before($clonedItem);
    $clonedItem.animate({'height': $item.height()});

    $item.animate($clonedItem.position(), function  () {
      $clonedItem.detach();
      _super($item, container);
    });
  },

  // set $item relative to cursor position
  onDragStart: function ($item, container, _super) {
    var offset = $item.offset(),
        pointer = container.rootGroup.pointer;

    adjustment = {
      left: pointer.left - offset.left,
      top: pointer.top - offset.top
    };

    _super($item, container);
  },
  onDrag: function ($item, position) {
    $item.css({
      left: position.left - adjustment.left,
      top: position.top - adjustment.top
    });
  }
});


$('#saveBtn').click(function() {
    var counter = 0;
    var items = [];

    //Go through each column (OL) separately
    for (i = 1; i <=3; i++){
      var column = $('#list' + i);

      column.children('li').each(function(){

        //Create an object for each list item
        var item = {};
        item.order = counter;
        item.column = i;
        var itemID = $(this).attr('id');
        item.workid = itemID.split("_")[1];
        items.push(item);
        counter = counter + 1;
      });
    }

    var jsonPacket = JSON.stringify(items);

    $.ajax({
      type: "POST",
      url: "save_admin.php",
      data: {json: jsonPacket},
      success: function(data){
        alert("save successful");
      },
      failure: function(errMsg){
        alert(errMsg);
      }
    });

});
