// /frontend/src/components/CheckoutForm.js
import React, { useState } from "react";
import axios from "axios";
import { Form, Button, Container, Alert } from "react-bootstrap";

const CheckoutForm = () => {
  const [form, setForm] = useState({ name: "", address: "", phone: "", paymentMethod: "Cash on Delivery" });
  const [cart, setCart] = useState([]);
  const [alert, setAlert] = useState({ type: "", message: "" });

  // Fetch cart items
  React.useEffect(() => {
    axios.get("/api/cart").then((response) => setCart(response.data)).catch(console.error);
  }, []);

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const response = await axios.post("/api/checkout", { ...form });
      setAlert({ type: "success", message: "Order placed successfully!" });
      setCart([]);
    } catch (error) {
      setAlert({ type: "danger", message: "Failed to place the order. Please try again." });
    }
  };

  return (
    <Container>
      <h2>Checkout</h2>
      {alert.message && <Alert variant={alert.type}>{alert.message}</Alert>}
      <Form onSubmit={handleSubmit}>
        <Form.Group>
          <Form.Label>Name</Form.Label>
          <Form.Control type="text" value={form.name} onChange={(e) => setForm({ ...form, name: e.target.value })} required />
        </Form.Group>
        <Form.Group>
          <Form.Label>Address</Form.Label>
          <Form.Control type="text" value={form.address} onChange={(e) => setForm({ ...form, address: e.target.value })} required />
        </Form.Group>
        <Form.Group>
          <Form.Label>Phone</Form.Label>
          <Form.Control type="text" value={form.phone} onChange={(e) => setForm({ ...form, phone: e.target.value })} required />
        </Form.Group>
        <Form.Group>
          <Form.Label>Payment Method</Form.Label>
          <Form.Control as="select" value={form.paymentMethod} onChange={(e) => setForm({ ...form, paymentMethod: e.target.value })}>
            <option>Cash on Delivery</option>
            <option>Credit Card</option>
          </Form.Control>
        </Form.Group>
        <Button type="submit">Confirm Order</Button>
      </Form>
      <h3>Cart Summary</h3>
      <ul>
        {cart.map((item) => (
          <li key={item.id}>{item.name} - {item.quantity} x ${item.price}</li>
        ))}
      </ul>
    </Container>
  );
};

export default CheckoutForm;
