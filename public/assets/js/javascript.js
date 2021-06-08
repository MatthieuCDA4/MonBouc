function gouvCommune() 
{
    cpostal = document.getElementById("code_postal").value;
    
    const method = 'GET';
    const url = 'https://geo.api.gouv.fr/communes?codePostal=' + cpostal;
    
    console.log();
    const xhr = new XMLHttpRequest();
    xhr.open(method, url, true);

    xhr.onreadystatechange = () => 
    {
        if (xhr.readyState === 4 && xhr.status === 200) 
        {
            const result = JSON.parse(xhr.response);
            //console.log(cpostal);
            afficheVille(result);
        }
    }
    xhr.send();
}
function afficheVille(tabVille) 
{
    select = document.getElementById("ville");
    select.options.length = 0;
    for (let i = 0; i < tabVille.length; i++) 
    {
        let opt = tabVille[i].nom;
        let element = document.createElement("option");
        element.textContent = opt;
        element.value = opt;
        select.appendChild(element);

    }
}

function ConfirmDelete()
{
  var x = confirm("Voulez-vous quitter mon Bouc?");
  if (x)
      return true;
  else
    return false;
}

function ConfirmDelete()
{
  var x = confirm("Etes-vous sûr de vouloir envoyer ce livre?");
  if (x)
      return true;
  else
    return false;
}

