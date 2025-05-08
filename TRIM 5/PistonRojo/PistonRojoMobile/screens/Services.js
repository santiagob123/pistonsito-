import React from 'react';
import { View, Text, StyleSheet } from 'react-native';

const Services = () => {
  return (
    <View style={styles.container}>
      <Text style={styles.title}>Nuestros Servicios</Text>
      <Text style={styles.description}>
        Ofrecemos mantenimiento preventivo, reparación de motores, y más.
      </Text>
    </View>
  );
};

const styles = StyleSheet.create({
  container: { flex: 1, justifyContent: 'center', alignItems: 'center', padding: 20 },
  title: { fontSize: 24, fontWeight: 'bold', marginBottom: 20 },
  description: { fontSize: 16, textAlign: 'center', color: '#555' },
});

export default Services;