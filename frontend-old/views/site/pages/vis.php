<script src="../../vis-master/dist/vis.js"></script>
<script src="../../vis-master/dist/vis.min.js"></script>
<!-- https://raw.githubusercontent.com/almende/vis/master/dist/vis.js -->

<script>
   // create a DataSet
const options = {};
const data = new vis.DataSet(options);

// add items
// note that the data items can contain different properties and data formats
data.add([
  { id: 1, text: "item 1", date: new Date(2013, 6, 20), group: 1, first: true },
  { id: 2, text: "item 2", date: "2013-06-23", group: 2 },
  { id: 3, text: "item 3", date: "2013-06-25", group: 2 },
  { id: 4, text: "item 4" }
]);

// subscribe to any change in the DataSet
data.on("*", (event, properties, senderId) => {
  console.log("event", event, properties);
});

// update an existing item
data.update({ id: 2, group: 1 });

// remove an item
data.remove(4);

// get all ids
const ids = data.getIds();
console.log("ids", ids);

// get a specific item
const specificItem = data.get(1);
console.log("specific item", specificItem);

// get multiple specific items
const specificItems = data.get([1, 3]);
console.log("specific items", specificItems);

// retrieve a filtered subset of the data
const filteredItems = data.get({
  filter: item => {
    return item.group == 1;
  }
});
console.log("filtered items", filteredItems);
</script>