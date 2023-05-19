//BG MENU

const menuBtn = document.querySelector('.menu-btn');
const menu = document.querySelector('.menu');
const menuCloseBtn = document.querySelector('.menu-close-btn');

let menuOpen = false;

menuBtn.addEventListener('click', () => {
  if (!menuOpen) {
    menuBtn.classList.add('open');
    menu.classList.add('active');
    menuOpen = true;
  } else {
    menuBtn.classList.remove('open');
    menu.classList.remove('active');
    menuOpen = false;
  }
});

menuCloseBtn.addEventListener('click', () => {
  menuBtn.classList.remove('open');
  menu.classList.remove('active');
  menuOpen = false;
});






//MAP

var mymap = L.map('mapid').setView([48.8534, 2.3488], 4);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
  maxZoom: 18
}).addTo(mymap);

mymap.setMaxZoom(18); // limite le zoom maximum à 10
mymap.setMinZoom(3); // limite le zoom minimum à 5

var southWest = L.latLng(-84.68403609426875, -179.04437145040112);
var northEast = L.latLng(84.95382747942323, 178.71742150644576);
var bounds = L.latLngBounds(southWest, northEast);
    
mymap.setMaxBounds(bounds); // limite la carte au rectangle englobant la ville de Paris
mymap.on('drag', function() {
  mymap.panInsideBounds(bounds, { animate: false });
});

var isWorldCentered = false;
var isEuropeCentered = false;
var isFranceCentered = false;


function addPark() {
// Coordonnées des parcs de France
const parks = [
    //CENTRER SUR MONDE

    { name: "Venice Beach, Los Angeles, Californie, États-Unis", lat: 33.98710520802095, lng: -118.47551966215023 },
    { name: "Calisthenics Park - Berlin, Allemagne", lat: 52.48339774934475,  lng: 13.360588629202212 },
    { name: "Calisthenics Park - Berlin, Allemagne", lat: 52.52609143914982,  lng: 13.317360876140762 },
    { name: "Calisthenics Park - Berlin, Allemagne", lat: 52.493651220544805, lng: 13.478336332087233 },
    { name: "Workout Park - Melbourne, Australie", lat: -37.81286278846433,  lng: 144.94097556235238 },
    { name: "Workout Park - Melbourne, Australie", lat: 52.493651220544805, lng: 13.478336332087233 },
    { name: "Parque del Calistenico - Madrid, Espagne", lat: 40.41545652823711,  lng: -3.7434251149506976 },
    { name: "Parque del Calistenico - Madrid, Espagne", lat: 40.52306440141371,   lng: -3.710466130808763 },
    { name: "Le Street Workout Park - Paris, France", lat: 48.86307643496575, lng: 2.4082547594179693 },
    { name: "Le Street Workout Park - Paris, France", lat: 48.888522278558845, lng: 2.36620187650635 },
    { name: "Bondi Beach Outdoor Gym - Sydney, Australie", lat: -33.89021738009807, lng: 151.2804276474915 },
    { name: "Bondi Beach Outdoor Gym - Sydney, Australie", lat: -33.898594070962524, lng: 151.27428425153556 },
    { name: "Baristi Workout Park - Barcelone, Espagne", lat: 41.369433715876134, lng: 2.150207200374969 },
    { name: "Baristi Workout Park - Barcelone, Espagne", lat: 41.3978324247415, lng: 2.1936014269143844 },
    { name: "Calisthenics Unity - Amsterdam, Pays-Bas", lat: 52.393006090678604, lng: 4.864392771458193 },
    { name: "Calisthenics Unity - Amsterdam, Pays-Bas", lat: 52.3892347510744, lng: 4.944730295304159 },

    //CENTRER SUR EUROPE

    { name: "Kenguru Pro Street Workout Park - Budapest, Hongrie", lat: 47.521229275447126, lng: 19.041581151728344 },
    { name: "Kenguru Pro Street Workout Park - Budapest, Hongrie", lat: 47.48551196580587, lng: 19.05874728930226 },
    { name: "Ghetto Workout Rig - Varsovie, Pologne", lat: 47.53103946096706,  lng: 19.06934172543826 },
    { name: "Ghetto Workout Rig - Varsovie, Pologne", lat: 47.49468278962861,  lng: 19.03764367049922 },
    { name: "The Chainstore Parkour Academy - Londres, Royaume-Uni", lat: 51.51050811733476,   lng: -0.004635276719674051 },
    { name: "The Chainstore Parkour Academy - Londres, Royaume-Uni", lat: 40.71180164299932,  lng: -73.93565708871799 },
    { name: "Brooklyn Zoo NY - New York, États-Unis", lat: 40.71180164299932,  lng: -73.93565708871799 },
    { name: "Brooklyn Zoo NY - New York, États-Unis", lat: 40.71180164299932,  lng: -73.93565708871799 },


    // CENTRER SUR FRANCE

    { name: "Workout Park - Marseille", lat: 43.29152134966605, lng: 5.3700613970135365 },
    { name: "Workout Park - Marseille", lat: 43.26315156479445, lng: 5.37503957690997 },
    { name: "Workout Park - Lyon", lat: 45.74990768789476, lng: 4.834858775122053 },
    { name: "Workout Park - Lyon", lat: 45.73534690198945, lng: 4.816410540993026 },
    { name: "Calisthenics Park - Montpellier", lat: 43.64151930371952, lng: 3.8536687968804233 },
    { name: "Fitness Park - Bordeaux", lat: 44.85212761504344, lng: -0.5592229760722138 },
    { name: "Workout Park - Toulouse", lat: 43.5947966027477,   lng: 1.4172237277938922 },
    { name: "Workout Park - Strasbourg", lat: 48.6017150040978,   lng: 7.721747159484477 },
    { name: "Workout Park Épinal", lat:48.1865111507945, lng:6.443700798042038},

];


// Ajouter un marqueur avec une icône personnalisée pour chaque ville
parks.forEach(function(park) {
    var customIcon = new L.Icon({
      iconUrl: 'img/points/Point2.png',
      iconSize: [40, 40],
      iconAnchor: [15, 30],
      popupAnchor: [0, -30],
    });
  
    L.marker([park.lat, park.lng], { icon: customIcon }).addTo(mymap)
      .bindPopup("<b>" + park.name + "</b>");
  });

}




function addTown() {
    // Coordonnées des villes de France
    const Towns = [
        //CENTRER SUR MONDE
    
        { name: "Paris, France" , lat: 48.85612303619759, lng: 2.350809911699845 },
        { name: "Washington D.C. ,États-Unis" , lat: 38.9072, lng: -77.0369 },
        { name: "Moscou, Russie" , lat: 55.7558, lng: 37.6173 },
        { name: "Londres, Royaume-Uni" , lat: 51.5074, lng: -0.1278 },
        { name: "Pékin, Chine" , lat: 39.9042, lng: 116.4074 },
        { name: "Tokyo, Japon" , lat: 35.6895, lng: 139.6917 },
        { name: "Rome, Italie" , lat: 41.9028, lng: 12.4964 },
        { name: "Madrid, Espagne" , lat: 40.4168, lng: -3.7038 },
        { name: "Berlin, Allemagne" , lat: 52.5200, lng: 13.4050 },
        { name: "Mexico, Mexique" , lat: 19.4326, lng: -99.1332 },

        //CENTRER SUR L'EUROPE

        { name:"Amsterdam, Pays-Bas" , lat: 52.3676, lng: 4.9041},
        { name:"Bruxelles, Belgique" , lat: 50.8503, lng: 4.3517},
        { name:"Vienne, Autriche" , lat: 48.2082, lng: 16.3738},
        { name:"Lisbonne, Portugal" , lat: 38.7223, lng: -9.1393},
        { name:"Copenhague, Danemark" , lat: 55.6761, lng: 12.5683},
        { name:"Helsinki, Finlande" , lat: 60.1699, lng: 24.9384},
        { name:"Reykjavik, Islande" , lat: 64.1265, lng: -21.8174},
        { name:"Varsovie, Pologne" , lat: 52.2297, lng: 21.0122},
        { name:"Prague, République tchèque" , lat: 50.0755, lng: 14.4378},
        { name:"Budapest, Hongrie" , lat: 47.4979, lng: 19.0402},

        //CENTRER SUR LA FRANCE (BAGUETTE BAGUETTE)


        { name: "Marseille, France", lat: 43.2964, lng: 5.3700},
        { name: "Lyon, France", lat: 45.7640, lng: 4.8357},
        { name: "Toulouse, France", lat: 43.6045, lng: 1.4442},
        { name: "Nice, France", lat: 43.7102, lng: 7.2619},
        { name: "Nantes, France", lat: 47.2184, lng: -1.5536},
        { name: "Strasbourg, France", lat: 48.5734, lng: 7.7521},
        { name: "Montpellier, France", lat: 43.6108, lng: 3.8767},
        { name: "Bordeaux, France", lat: 44.8378, lng: -0.5792},
        { name: "Lille, France", lat: 50.6292, lng: 3.0573},
    ];
    
    
// Ajouter un marqueur avec une icône personnalisée pour chaque ville
Towns.forEach(function(Town) {
    var customIcon = new L.Icon({
      iconUrl: 'img/points/Point1.png',
      iconSize: [40, 40],
      iconAnchor: [15, 30],
      popupAnchor: [0, -30],
    });
  
    L.marker([Town.lat, Town.lng], { icon: customIcon }).addTo(mymap)
      .bindPopup("<b>" + Town.name + "</b>");
  });
  
    
}




function addHalls() {
    // Coordonnées des salles de sports de France
    const Halls = [
        //CENTRER SUR MONDE
    
        { name: "Gold's Gym Venice Beach, Los Angeles, États-Unis", lat: 33.9875, lng: -118.4727 },
        { name: "Virgin Active Milano-Corsico, Italie", lat: 45.4252, lng: 9.1038 },
        { name: "World Gym Taipei, Taïwan", lat: 25.0212, lng: 121.5312 },
        { name: "Fitness First Platinum, Sydney, Australie", lat: -33.8650, lng: 151.2094 },
        { name: "David Lloyd Amsterdam, Pays-Bas", lat: 52.3368, lng: 4.8897 },
        { name: "Virgin Active Singapore, Singapour", lat: 1.2821, lng: 103.8178 },
        { name: "Anytime Fitness Shibuya, Tokyo, Japon", lat: 35.6618, lng: 139.7041 },
        { name: "Reebok Sports Club Madrid, Espagne", lat: 40.4369, lng: -3.6957 },
        { name: "Fitness Factory Heliopolis, Le Caire, Égypte", lat: 30.1063, lng: 31.3396 },
        { name: "Grit Bxng, New York, États-Unis", lat: 40.7280, lng: -74.0034 },

        //CENTRER SUR L'EUROPE

        { name: "Fitness First Paris, France", lat: 48.8649, lng: 2.3412 },
        { name: "Holmes Place Vienna, Autriche", lat: 48.2167, lng: 16.3667 },
        { name: "DW Fitness First Liverpool, Royaume-Uni", lat: 53.4093, lng: -2.9895 },
        { name: "Gymkhana Club Madrid, Espagne", lat: 40.4192, lng: -3.6949 },
        { name: "Reebok Sports Club Canary Wharf, Londres, Royaume-Uni", lat: 51.5031, lng: -0.0194 },
        { name: "Olympic Casino Carlton, Riga, Lettonie", lat: 56.9589, lng: 24.1122 },
        { name: "Nuffield Health Fitness & Wellbeing Centre, Glasgow, Royaume-Uni", lat: 55.8622, lng: -4.2530 },
        { name: "Basefit.ch Zurich, Suisse", lat: 47.3857, lng: 8.5407 },
        { name: "F45 Training Dublin, Irlande", lat: 53.3441, lng: -6.2675 },
        { name: "HIT Fitness, Copenhague, Danemark", lat: 55.6874, lng: 12.5594 },

        //CENTRER SUR LA FRANCE (BAGUETTE BAGUETTE)


        { name: "Club Med Gym Paris, France", lat: 48.8769, lng: 2.3042 },
        { name: "Forest Hill Paris, France", lat: 48.8719, lng: 2.3542 },
        { name: "Basic-Fit Toulouse, France", lat: 43.6149, lng: 1.4482 },
        { name: "Keep Cool Marseille, France", lat: 43.2965, lng: 5.3699 },
        { name: "Amazonia Rennes, France", lat: 48.1075, lng: -1.6744 },
        { name: "Club Moving La Rochelle, France", lat: 46.1708, lng: -1.1367 },
        { name: "Fitness Park Lyon, France", lat: 45.7640, lng: 4.8357 },
        { name: "Elancia Nantes, France", lat: 47.2015, lng: -1.5440 },
        { name: "Magic Form Lille, France", lat: 50.6115, lng: 3.1392 },
        { name: "Gigagym Bordeaux, France", lat: 44.8368, lng: -0.5803 },
    ];
    
    
// Ajouter un marqueur avec une icône personnalisée pour chaque ville
Halls.forEach(function(Hall) {
    var customIcon = new L.Icon({
      iconUrl: 'img/points/Point3.png',
      iconSize: [40, 40],
      iconAnchor: [15, 30],
      popupAnchor: [0, -30],
    });
  
    L.marker([Hall.lat, Hall.lng], { icon: customIcon }).addTo(mymap)
      .bindPopup("<b>" + Hall.name + "</b>");
  });
  
    
}