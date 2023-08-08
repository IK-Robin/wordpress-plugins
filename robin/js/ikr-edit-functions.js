
function edit_from_list_F (datas){
    const edit_from_list = document.querySelectorAll(".edit_from_list");

    edit_from_list.forEach(editItems =>{
        editItems.addEventListener('click',(editEvent) =>{
            let editId = editEvent.target.dataset.id;
            ikrHeidSubmitForm.style.display = "none";
            rdata_edit_from.style.display = "block";
            console.log()
            datas.map(editItem=>{
                if (editItem.map_id === editId){
                    map_id_edit.value = editId;
                    itemDetail(editItem)
                }
            })

        });
          
    });



  }

