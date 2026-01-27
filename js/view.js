function initPage() {
  if(Tabulator === undefined) {
    setTimeout(initPage, 100);
    return;
  }
  let table = new Tabulator("#themeTable", {
    ajaxURL: "api/v1/themes",
    pagination: true,
    paginationSize: 20,
    columns: [
      {title: "Name", field: "name", width: '75%'},
      {title: "Presenting", field: "presenting", width: '20%'}
    ]
  });
  table.on('tableBuilt', () => {
    table.setData();
  });
}

window.onload = initPage;
