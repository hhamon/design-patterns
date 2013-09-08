Composite
=========

**Type** : structural

Le pattern **Composite** permet de traiter un groupe d'objets de la même manière qu'une seule instance. Le but d'un composite consiste à composer des objets en structures arborescentes de manière à représenter des hiérarchies complètes ou partielles. En d'autres termes, le patron Composite laisse les clients traiter les objets individuels ou composés de manière uniforme.

Structure
---------

### Composant

C'est l'abstraction pour tous les composants, y compris ceux qui sont composés. Il s'agit généralement d'une classe abstraite ou bien simpliment d'une interface qui définit un type de base et une API publique.

### Feuille

Une feuille représente un composant qui ne contient pas de sous-éléments. Un composant de type « feuille » implémente le comportement par défaut définit par le composant.

### Composite

Un composite est un composant qui contient des sous-éléments (feuilles et/ou composites). Il implémente le comportement par défaut du composant en faisant appel aux enfants qu'il contient.

### Client

C'est le programme principal qui manipule de manière uniforme un composant (feuille ou objet composite).

Exemple
-------

Un site e-commerce vend des produits individuels. En raison des fêtes de fin d'année, le site souhaite vendre des produits sous forme de lots spéciaux. Par exemple, acheter un lot spécial comprenant deux livres ou bien un livre et sa copie numérique. Chaque lot spécial de produits doit donc être traité comme un produit unitaire.

Le prix d'un package est définit de la manière suivante :

* Le prix du package est fixé par le vendeur
* Le prix du package est la somme des prix des produits qu'il contient

Solution
--------

    <?php
    
    namespace Blend\Model\Store;
    
    interface ProductInterface
    {
        /**
         * Returns the product's reference.
         *
         * @return string
         */
        public function getReference();
    
        /**
         * Returns the product's name.
         *
         * @return string
         */
        public function getName();
    
        /**
         * Returns the product's price.
         *
         * @return \SebastianBergmann\Money\Money
         */
        public function getPrice();
    
        /**
         * Returns the product's weight.
         *
         * @return \Blend\Model\Physic\Mass
         */
        public function getMass();
    
        /**
         * Returns the product's volume.
         *
         * @return \Blend\Model\Physic\Volume
         */
        public function getVolume();
    }

    <?php
    
    namespace Blend\Model\Store;
    
    use Blend\Model\Physic\Mass;
    use Blend\Model\Physic\Volume;
    use SebastianBergmann\Money\Money;
    
    class Product implements ProductInterface
    {
        /**
         * The product's reference.
         *
         * @var string
         */
        protected $reference;
    
        /**
         * The product's name.
         *
         * @var string
         */
        protected $name;
    
        /**
         * The product's price.
         *
         * @var Money
         */
        protected $price;
    
        /**
         * The product's mass.
         *
         * @var Mass
         */
        protected $mass;
    
        /**
         * The product's volume.
         *
         * @var Volume
         */
        protected $volume;
    
        /**
         * Constructor.
         *
         * @param string $reference
         * @param string $name
         * @param Money $price
         * @param Mass $mass
         * @param Volume $volume
         */
        public function __construct($reference, $name, Money $price, Mass $mass, Volume $volume)
        {
            $this->reference = $reference;
            $this->name      = $name;
            $this->price     = $price;
            $this->mass      = $mass;
            $this->volume    = $volume;
        }
    
        /**
         * Returns the product's reference.
         *
         * @return string
         */
        public function getReference()
        {
            return $this->reference;
        }
    
        /**
         * Returns the product's name.
         *
         * @return string
         */
        public function getName()
        {
            return $this->name;
        }
    
        /**
         * Returns the product's price.
         *
         * @return \SebastianBergmann\Money\Money
         */
        public function getPrice()
        {
            return $this->price;
        }
    
        /**
         * Returns the product's weight.
         *
         * @return \Blend\Model\Physic\Mass
         */
        public function getMass()
        {
            return $this->mass;
        }
    
        /**
         * Returns the product's volume.
         *
         * @return \Blend\Model\Physic\Volume
         */
        public function getVolume()
        {
            return $this->volume;
        }
    }


    <?php

    namespace Blend\Model\Store;
    
    use Blend\Model\Physic\Mass;
    use Blend\Model\Physic\Volume;
    use SebastianBergmann\Money\Money;
    
    class Bundle extends Product
    {
        /**
         * A collection of products.
         *
         * @var ProductInterface[]
         */
        protected $products;
    
        public function __construct($reference, $name, Money $price = null, Mass $mass = null, Volume $volume = null)
        {
            $this->reference = $reference;
            $this->products  = array();
            $this->volume    = $volume;
            $this->price     = $price;
            $this->name      = $name;
            $this->mass      = $mass;
        }
    
        public function add(ProductInterface $product)
        {
            $this->products[] = $product;
        }
    
        public function getPrice()
        {
            if ($this->price) {
                return $this->price;
            }
    
            return $this->getPricesSum();
        }
    
        public function getMass()
        {
            if ($this->mass) {
                return $this->mass;
            }
            
            return $this->getMassesSum();
        }
    
        public function getVolume()
        {
            if ($this->volume) {
                return $this->volume;
            }
    
            return $this->getVolumesSum();
        }
    
        private function getPricesSum()
        {
            $price = null;
            foreach ($this->products as $product) {
                if (null === $price) {
                    $price = $product->getPrice();
                } else {
                    $price = $price->add($product->getPrice());
                }
            }
    
            return $price;
        }
    
        private function getMassesSum()
        {
            $mass = null;
            foreach ($this->products as $product) {
                if (null === $mass) {
                    $mass = $product->getMass();
                } else {
                    $mass = $mass->add($product->getMass());
                }
            }
    
            return $mass;
        }
    
        private function getVolumesSum()
        {
            $volume = null;
            foreach ($this->products as $product) {
                if (null === $volume) {
                    $volume = $product->getVolume();
                } else {
                    $volume = $volume->add($product->getVolume());
                }
            }
    
            return $volume;
        }
    }


    <?php
    
    namespace Blend\Model\Store;
    
    class HardProduct extends Product
    {
    
    }

    <?php
    
    namespace Blend\Model\Store;
    
    use Blend\Model\Physic\Mass;
    use Blend\Model\Physic\Volume;
    use SebastianBergmann\Money\Money;
    
    class DigitalProduct extends Product
    {
        /**
         * Constructor.
         *
         * @param string $reference
         * @param string $name
         * @param Money $price
         */
        public function __construct($reference, $name, Money $price)
        {
            $this->reference = $reference;
            $this->name = $name;
            $this->price = $price;
        }
    
        /**
         * Returns the product's mass.
         *
         * @return Mass
         */
        final public function getMass()
        {
            return new Mass(0);
        }
    
        /**
         * Returns the product's volume.
         *
         * @return Volume
         */
        final public function getVolume()
        {
            return new Volume(0);
        }
    }

    <?php
    
    namespace Blend\Model\Store;
    
    class PaperBook extends HardProduct
    {
    
    }

    <?php
    
    namespace Blend\Model\Store;
    
    class EBook extends DigitalProduct
    {
    
    }

    <?php
    
    namespace Blend\Model\Store;
    
    class ETicket extends DigitalProduct
    {
    
    }


Autres applications
-------------------

* Menu de navigation
* Formulaires (champs et sous-formulaire)
* Livre + chapitre + texte
* Album + pistes (album de musique)
* Composition d'opérations arithmétiques : (1 + 2 + (4 * 3))
* Arborescence dossier / fichiers



