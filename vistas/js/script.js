const sectionPanel = (element) => {
    document.getElementById(`check-${element}`).checked ? 
    document.getElementById(`${element}`).style.display = '': 
    document.getElementById(`${element}`).style.display = 'none'; 
    console.log(document.getElementById(`check-${element}`).checked ? 
    document.getElementById(`${element}`).style.display = '': 
    document.getElementById(`${element}`).style.display = 'none');
};