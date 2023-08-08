const ikrgooMap = document.querySelector(".svg_img_obj");

const ikrtooltip = document.getElementById("tooltip");
const detail = document.getElementById("detail");
const map_img = document.getElementById("map_img");
const map_details = document.getElementById("map_details");
const plotId = document.getElementById("plotId");
const detail_name = document.getElementById("detail_name");
const detail_des = document.getElementById("detail_des");
const closebtn = document.getElementById("close");
const ikrHeidSubmitForm = document.getElementById("rdata_from");
const rdata_edit_from = document.getElementById("rdata_edit_from");
const checkbox = document.getElementById("ikrCheckbox");
let tab = [];
// check is edit true or false
let isEdit = false;

const isEditBtn = document.getElementById("isEditBtn");



// console.log(closebtn)
function onLoadshowdata(datas) {
  // get the svg
  const ikrsvgDocc = ikrgooMap.contentDocument;
  const ikrsvg = ikrsvgDocc.querySelector("svg");

  let ikrItems = ikrsvg.querySelectorAll(
    "rect,path",
    "circle",
    "polygon",
    "text"
  );

  // all functions
  // add the list item in the bottom
  function displayDatabaseData(data) {
    const databaseData = document.getElementById("database-data");
    let html = "";
    data.forEach(function (item) {
      html += `<div class ="idk_map_detail">
        
        <p>ID: ${item.id}</p>
                  <p>Title: ${item.title}</p>
                  <p>Description: ${item.map_des}</p>
                  <p>Hover Color: ${item.hov_color}</p>
      
                  <button type ="button" data-id=${item.map_id} class="edit_from_list">edit</button>

                  
        </div>
                  
              `;
      databaseData.innerHTML = html;
    });
    // databaseData.innerHTML = html;
  }

  function ikrshowTooltip(hover) {
    let mapId = hover.target.id;

    datas.map((item) => {
      // set the fill colore
      ikrColorThePath(hover, mapId, item.hov_color, item.map_id);

      if (mapId == item.map_id) {
        ikrtooltip.style.display = "block";
        ikrtooltip.innerHTML = item.title;
        let cx = hover.clientX;
        let cy = hover.clientY;
        ikrtooltip.style.left = `${cx}px`;
        ikrtooltip.style.top = `${cy}px`;
      }
    });
  }

  // add mouse out functions

  const ikrmouseOutF = (mout) => {
    let mapId = mout.target.id;
    ikrtooltip.style.display = "none";
    datas.map((item) => {
      if (mout.target.tagName == "path") {
        let targetPath = mout.target;
        let getId = targetPath.getAttribute("id");
        if (mapId == getId && getId === item.map_id) {
          targetPath.setAttribute("fill", item.fill_color);
        }
      }
    });
  };

  const ikrClickEvFunc = (clickEV) => {
    // ikrtooltip.style.display = "none";
    // ikrItems.forEach((clickItem) => {
    //   clickItem.removeEventListener("mousemove", ikrshowTooltip);
    //   clickItem.removeEventListener("mousemove", ikrmouseOutF);
    // });
      
  let dd =  document.getElementById('editor-container_edit');
  console.log(dd)
  
  dd.innerHTML = 'hh'
    itemDetailEmpty();
    let mapId = clickEV.target.id;
    map_id.value = mapId;
    map_id_edit.value = mapId;
    checkbox.checked = true;

    if (datas.length == 0) {
      // console.log('emp')
    } else {
      // check the data and make hide and show the input from ;
      let i = 0;
      let item;

      do {
        item = datas[i];
        // console.log(item)
        if (mapId === item.map_id) {
          if (isEdit) {
            rdata_edit_from.style.display = "block";
            ikrHeidSubmitForm.style.display = "none";
            
          } else {
            ikrHeidSubmitForm.style.display = "none";
          }
        } else if (mapId !== item.map_id) {
          ikrHeidSubmitForm.style.display = "block";
          rdata_edit_from.style.display = "none";
        }
        i++;
      } while (i < datas.length && mapId !== item.map_id);
      // check the data and make hide and show the input from ;
    }

    datas.forEach((item) => {
      if (clickEV.target.tagName === "path") {
        let targetPath = clickEV.target;
        let getId = targetPath.getAttribute("id");

        // ikrItems.forEach((itemr) => {
        //   itemr.removeEventListener("mousemove", ikrshowTooltip);
        //   itemr.removeEventListener("mouseout", ikrmouseOutF);
        // });

        if (item.map_id === mapId) {
          itemDetail(item);

          closebtn.addEventListener("click", (e) => {
            detail.style.display = "none";
            isEdit = false;
            isEditBtn.innerHTML = "edit";
            ikrItems.forEach((items) => {
              items.addEventListener("mousemove", ikrshowTooltip);
              items.addEventListener("mouseout", ikrmouseOutF);
              // items.addEventListener("click", ikrClickEvFunc);
            });
            targetPath.setAttribute("fill", item.fill_color);
          });

          detail.style.display = "block";
          plotId.innerText = item.map_id;
          detail_name.innerHTML = item.title;


          detail_des.innerHTML = item.map_des;



          map_img.setAttribute(
            "src",
            item.map_img === null ? "" : item.map_img
          );
          let cx = clickEV.clientX;
          let cy = clickEV.clientY;

          if (cx < 100 || cx < 160) {
            detail.style.left = `${cx + 100}px`;
          } else {
            detail.style.left = `${cx}px`;
          }

          if (cy < 100) {
            detail.style.top = `${cy + 100}px`;
          } else {
            detail.style.top = `${cy}px`;
          }
        }

        if (getId === item.map_id) {
          targetPath.setAttribute("fill", item.click_color);
        }
      }
    });



    isEditBtn.addEventListener("click", () => {
      if (isEdit == false) {
        isEdit = true;
        isEditBtn.innerHTML = "stop editing";
        ikrHeidSubmitForm.style.display = "none";
        rdata_edit_from.style.display = "block";
        edit_from_list_F(datas);
      } else {
        isEditBtn.innerHTML = "edit";
        isEdit = false;
      }
    });

  };

  // all functions

  // set the fill color of the item
  // and check the active path and deactive path
  ikrItems.forEach((items) => {
    let ide = items.id;
    // console.log('ID:', ide);
    let i = 0;
    let item;

    datas.map((item) => {
      if (item.map_id == ide) {
        // console.log(item)
        // check is active  == 0
        if (item.is_active === "0") {
          items.setAttribute("fill", item.fill_color);

          items.addEventListener("mouseenter", (ids) => {
            console.log("first 0");
            items.addEventListener("click", () => {
              ikrHeidSubmitForm.style.display = "none";
              rdata_edit_from.style.display = "block";
              itemDetail(item);
              map_id_edit.value = ide;
            });
            // map_id_edit.value = ids.target.id;
            // console.log(ids.target.id)

            items.removeEventListener("mousemove", ikrshowTooltip);
            items.removeEventListener("mousemove", ikrmouseOutF);
            items.removeEventListener("click", ikrClickEvFunc);
          });

          items.addEventListener("mouseout", () => {
            items.addEventListener("mousemove", ikrshowTooltip);
            items.addEventListener("mousemove", ikrmouseOutF);
            items.addEventListener("click", ikrClickEvFunc);
          });
        }
        // check is active  == 1 if 1 then set the fill color
        if (item.is_active === "1") {
          console.log(item.is_active);
          items.setAttribute("fill", item.fill_color);
        }
      }
    });
  });
  // select the svg path
  // console.log(tab);

  // set the color on mouse enter and out
  const ikrColorThePath = (events, mapId, fill_color, map_id) => {
    // check the terget path
    if (events.target.tagName == "path") {
      let targetPath = events.target;
      let getId = targetPath.getAttribute("id");

      if (mapId == getId && getId === map_id) {
        targetPath.setAttribute("fill", fill_color);
      }
    }
  };
  // set the color on mouse enter and out
  ikrItems.forEach((ev, ind) => {
    let ids = ev.id;

    let id = {
      id: ids,
    };
    tab.push(id);
  });
  // add hover effect on mouse enter to the item

  function revalidetAjaxRequest() {
    // console.log('re')

    // declear tooltip functions

    displayDatabaseData(datas);

    // add mouse out functions

    ikrItems.forEach((clickItem) => {
      clickItem.addEventListener("mousemove", ikrshowTooltip);
    });

    ikrItems.forEach((clickItem) => {
      clickItem.addEventListener("mousemove", ikrshowTooltip);
    });

    // click to show the data on detail popup
    ikrItems.forEach((clickItem) => {
      clickItem.addEventListener("click", ikrClickEvFunc);
    });

    // functions on mouse oute

    ikrItems.forEach((mout) => {
      mout.addEventListener("mouseout", ikrmouseOutF);
    });
  }
  revalidetAjaxRequest();
  // add the edit function from the edti list
  edit_from_list_F(datas);
  // add the edit function from the edti list
}

function sendDataToDB(datas) {
  onLoadshowdata(datas);
  // setInterval(revalidetAjaxRequest, 1000);
}

function shoes() {
  fetchAjaxRequest("rdata_fetch_data", (response) => {
    onLoadshowdata(response);

    //  console.log(response)
  });
}

// window.addEventListener('load',shoes());
// add all edit from input
function itemDetail(item) {
  ikrTitle_edit.value = item.title;

  // ikrdes_edit.value = item.map_des;
  hovecolor_edit.value = item.hov_color;
  typeHovcolor_edit.value = item.hov_color;
  fill_color_edit.value = item.fill_color;
  filltype_edit.value = item.fill_color;
  clickcolor_edit.value = item.click_color;
  typeClickColor_edit.value = item.click_color;
  const ikrCheckbox_edit = document.getElementById("ikrCheckbox_edit");
  ikrCheckbox_edit.checked = item.is_active == 1 ? true : false;
}
function itemDetailEmpty(item) {
  const ikrCheckbox_edit = document.getElementById("ikrCheckbox_edit");

  map_id.value = '';
  ikrTitle.value = "";
  // ikrdes.value = '';

  ikrCheckbox_edit.checked =  true;
  image_url.value ='';

}
