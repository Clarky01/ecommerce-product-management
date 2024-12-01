import React, { useEffect, useState } from 'react';
import { Button, Card, Row, Col } from 'react-bootstrap';
import axios from 'axios';
import { useCart } from '../context/CartContext';

const ProductList = () => {
    const [products, setProducts] = useState([]);
    const { addToCart } = useCart();

    useEffect(() => {
        axios.get('http://127.0.0.1:8000/api/products')
            .then(response => setProducts(response.data));
    }, []);

    return (
        <Row>
            {products.map(product => (
                <Col key={product.id} sm={6} md={4} lg={3}>
                    <Card>
                        <Card.Body>
                            <Card.Title>{product.name}</Card.Title>
                            <Card.Text>${product.price}</Card.Text>
                            <Button onClick={() => addToCart(product)}>Add to Cart</Button>
                        </Card.Body>
                    </Card>
                </Col>
            ))}
        </Row>
    );
};

export default ProductList;
