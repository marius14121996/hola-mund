CREATE TABLE posts (
    id smallint unsigned NOT NULL auto_increment,
    title varchar(255) NOT NULL,
    excerpt text NOT NULL,
    content text NOT NULL,
    published_on datetime NOT NULL,

    PRIMARY KEY (id)
);

INSERT INTO posts ( title, excerpt, content, published_on ) VALUES 
('Hola mundo',
'Este es el extracto del primer post',
'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur, voluptatum ab earum id deserunt incidunt facilis. Magnam fuga sed dicta inventore libero eligendi dolor, aperiam corrupti nisi expedita esse tempore!',
'2021-06-21 09:30:00'
);

INSERT INTO posts ( title, excerpt, content, published_on ) VALUES 
('La vida es bella',
'Este es el extracto del segundo post',
'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur, voluptatum ab earum id deserunt incidunt facilis. Magnam fuga sed dicta inventore libero eligendi dolor, aperiam corrupti nisi expedita esse tempore!',
'2021-06-22 10:30:00'
);