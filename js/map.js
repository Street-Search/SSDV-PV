var mymap = L.map('mapid').setView([48.8534, 2.3488], 13);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
    maxZoom: 18
}).addTo(mymap);
L.marker([48.8534, 2.3488]).addTo(mymap)
    .bindPopup("<b>Bienvenue à Paris !</b>").openPopup();


    // Fonction pour trouver des villes avec l'API Nominatim
    function trouverVilles(texteEntree) {
        const url = `https://nominatim.openstreetmap.org/search?q=${texteEntree}&format=json&limit=10`;
        return fetch(url)
          .then(response => response.json())
          .then(resultats => {
            const villes = [];
            for (const resultat of resultats) {
              if (resultat.type === 'city') {
                villes.push(resultat.display_name);
              }
            }
            return villes;
          });
      }
      
      // Fonction pour afficher les résultats de recherche
      function afficherResultats(resultats) {
        const ul = document.getElementById('resultats');
        ul.innerHTML = '';
        for (const resultat of resultats) {
          const li = document.createElement('li');
          li.textContent = resultat;
          li.addEventListener('click', () => {
            alert(resultat);
          });
          ul.appendChild(li);
        }
      }
      
      // Événement de recherche
      const recherche = document.getElementById('recherche');
      recherche.addEventListener('input', () => {
        const texteEntree = recherche.value.trim();
        if (texteEntree) {
          trouverVilles(texteEntree)
            .then(villes => afficherResultats(villes));
        } else {
          afficherResultats([]);
        }
      });