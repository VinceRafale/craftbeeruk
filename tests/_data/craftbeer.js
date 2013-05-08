
/** User indexes **/
db.getCollection("User").ensureIndex({
  "_id": NumberInt(1)
},[
  
]);

/** User indexes **/
db.getCollection("User").ensureIndex({
  "usernameCanonical": NumberInt(1)
},{
  "unique": true
});

/** User indexes **/
db.getCollection("User").ensureIndex({
  "emailCanonical": NumberInt(1)
},{
  "unique": true
});

/** beers indexes **/
db.getCollection("beers").ensureIndex({
  "_id": NumberInt(1)
},[
  
]);

/** beers indexes **/
db.getCollection("beers").ensureIndex({
  "breweryId": NumberInt(1)
},[
  
]);

/** comments indexes **/
db.getCollection("comments").ensureIndex({
  "_id": NumberInt(1)
},[
  
]);

/** comments indexes **/
db.getCollection("comments").ensureIndex({
  "location.$id": NumberInt(1)
},[
  
]);

/** comments indexes **/
db.getCollection("comments").ensureIndex({
  "author.$id": NumberInt(1)
},[
  
]);

/** comments indexes **/
db.getCollection("comments").ensureIndex({
  "created": NumberInt(1)
},[
  
]);

/** locations indexes **/
db.getCollection("locations").ensureIndex({
  "_id": NumberInt(1)
},[
  
]);

/** locations indexes **/
db.getCollection("locations").ensureIndex({
  "coordinates": "2d"
},[
  
]);

/** locations indexes **/
db.getCollection("locations").ensureIndex({
  "osmId": NumberInt(1)
},[
  
]);

/** locations indexes **/
db.getCollection("locations").ensureIndex({
  "slug": NumberInt(1)
},[
  
]);

/** User records **/

/** beers records **/

/** comments records **/

/** locations records **/
db.getCollection("locations").insert({
  "_id": ObjectId("50c214d0ddd16886b1000000"),
  "amenity": "pub",
  "centre": {
    "latitude": 53.4742469,
    "longitude": -2.2374669
  },
  "coordinates": [
    {
      "latitude": 53.4742469,
      "longitude": -2.2374669
    }
  ],
  "created": ISODate("2012-12-07T16:09:52.0Z"),
  "name": "Joshua Brooks",
  "osmId": NumberInt(30969137),
  "real_ale": true,
  "real_cider": false
});
db.getCollection("locations").insert({
  "_id": ObjectId("50c214d0ddd16886b1000001"),
  "amenity": "pub",
  "centre": {
    "latitude": 53.4882666,
    "longitude": -2.2322764
  },
  "coordinates": [
    {
      "latitude": 53.4882666,
      "longitude": -2.2322764
    }
  ],
  "created": ISODate("2012-12-07T16:09:52.0Z"),
  "name": "Marble Arch Inn",
  "osmId": NumberInt(307642219),
  "real_ale": true,
  "real_cider": true
});
db.getCollection("locations").insert({
  "_id": ObjectId("50c214d0ddd16886b1000002"),
  "amenity": "bar",
  "centre": {
    "latitude": 53.4735444,
    "longitude": -2.2412136
  },
  "coordinates": [
    {
      "latitude": 53.4735444,
      "longitude": -2.2412136
    }
  ],
  "created": ISODate("2012-12-07T16:09:52.0Z"),
  "name": "The Font",
  "osmId": NumberInt(426959803),
  "real_ale": true,
  "real_cider": false
});
db.getCollection("locations").insert({
  "_id": ObjectId("50c214d0ddd16886b1000003"),
  "address": "82 Leather Lane, London, EC1N 7TR",
  "amenity": "pub",
  "centre": {
    "latitude": 51.5211926,
    "longitude": -0.1097072
  },
  "coordinates": [
    {
      "latitude": 51.5211926,
      "longitude": -0.1097072
    }
  ],
  "created": ISODate("2012-12-07T16:09:52.0Z"),
  "name": "The Craft Beer Co.",
  "osmId": NumberInt(500016552),
  "real_ale": true,
  "real_cider": false
});
db.getCollection("locations").insert({
  "_id": ObjectId("50c214d0ddd16886b1000004"),
  "address": "39-41\nPort Street\nM1 2EQ",
  "amenity": "pub",
  "centre": {
    "latitude": 53.4820733,
    "longitude": -2.2318876
  },
  "coordinates": [
    {
      "latitude": 53.4820733,
      "longitude": -2.2318876
    }
  ],
  "created": ISODate("2012-12-07T16:09:52.0Z"),
  "name": "Port Street Beer House",
  "osmId": NumberInt(1297083378),
  "real_ale": true,
  "real_cider": true,
  "website": "http:\/\/www.portstreetbeerhouse.co.uk\/"
});
db.getCollection("locations").insert({
  "_id": ObjectId("50c214d0ddd16886b1000005"),
  "centre": {
    "latitude": 53.4229518,
    "longitude": -2.1993462
  },
  "coordinates": [
    {
      "latitude": 53.4229518,
      "longitude": -2.1993462
    }
  ],
  "created": ISODate("2012-12-07T16:09:52.0Z"),
  "name": "The Beer Shop",
  "osmId": NumberInt(1640831015),
  "real_ale": true,
  "real_cider": true,
  "website": "http:\/\/www.ukbeershop.com"
});
db.getCollection("locations").insert({
  "_id": ObjectId("50c214d0ddd16886b1000006"),
  "amenity": "bar",
  "centre": {
    "latitude": 53.4780917,
    "longitude": -2.2472173
  },
  "coordinates": [
    {
      "latitude": 53.4780917,
      "longitude": -2.2472173
    }
  ],
  "created": ISODate("2012-12-07T16:09:52.0Z"),
  "name": "BrewDog Manchester",
  "osmId": NumberInt(1765136160),
  "real_ale": false,
  "real_cider": false
});
db.getCollection("locations").insert({
  "_id": ObjectId("50c214d0ddd16886b1000007"),
  "amenity": "pub",
  "centre": {
    "latitude": 53.4743764,
    "longitude": -2.252128
  },
  "coordinates": [
    {
      "latitude": 53.4743764,
      "longitude": -2.252128
    }
  ],
  "created": ISODate("2012-12-07T16:09:52.0Z"),
  "name": "Knott Bar",
  "osmId": NumberInt(1898421317),
  "real_ale": true,
  "real_cider": false
});
db.getCollection("locations").insert({
  "_id": ObjectId("50c214d0ddd16886b1000008"),
  "address": "39-41\nEdge Street\nM4 1HW",
  "amenity": "bar",
  "centre": {
    "latitude": 53.48424518,
    "longitude": -2.23598224
  },
  "coordinates": [
    {
      "latitude": 53.4843627,
      "longitude": -2.2359702
    },
    {
      "latitude": 53.4842145,
      "longitude": -2.2357213
    },
    {
      "latitude": 53.4840664,
      "longitude": -2.235996
    },
    {
      "latitude": 53.4842196,
      "longitude": -2.2362535
    },
    {
      "latitude": 53.4843627,
      "longitude": -2.2359702
    }
  ],
  "created": ISODate("2012-12-07T16:09:52.0Z"),
  "name": "Common",
  "osmId": NumberInt(31894775),
  "real_ale": false,
  "real_cider": false
});
db.getCollection("locations").insert({
  "_id": ObjectId("50c214d0ddd16886b1000009"),
  "address": "190\nEuston Road\nLondon\nNW1 2EF",
  "amenity": "pub",
  "centre": {
    "latitude": 51.52690822,
    "longitude": -0.13257574
  },
  "coordinates": [
    {
      "latitude": 51.5268669,
      "longitude": -0.1325891
    },
    {
      "latitude": 51.5269023,
      "longitude": -0.1324919
    },
    {
      "latitude": 51.5269702,
      "longitude": -0.1325557
    },
    {
      "latitude": 51.5269348,
      "longitude": -0.1326529
    },
    {
      "latitude": 51.5268669,
      "longitude": -0.1325891
    }
  ],
  "created": ISODate("2012-12-07T16:09:52.0Z"),
  "name": "Euston Tap",
  "osmId": NumberInt(93710880),
  "real_ale": true,
  "real_cider": false,
  "website": "http:\/\/eustontap.com"
});
db.getCollection("locations").insert({
  "_id": ObjectId("50c214d0ddd16886b100000a"),
  "amenity": "pub",
  "centre": {
    "latitude": 53.4123573,
    "longitude": -2.1672543285714
  },
  "coordinates": [
    {
      "latitude": 53.412456,
      "longitude": -2.167253
    },
    {
      "latitude": 53.4124032,
      "longitude": -2.1673585
    },
    {
      "latitude": 53.4123313,
      "longitude": -2.1672624
    },
    {
      "latitude": 53.4123021,
      "longitude": -2.1673284
    },
    {
      "latitude": 53.4122358,
      "longitude": -2.1672398
    },
    {
      "latitude": 53.4123167,
      "longitude": -2.1670852
    },
    {
      "latitude": 53.412456,
      "longitude": -2.167253
    }
  ],
  "created": ISODate("2012-12-07T16:09:52.0Z"),
  "name": "The Magnet",
  "osmId": NumberInt(189504998),
  "real_ale": true,
  "real_cider": true
});
