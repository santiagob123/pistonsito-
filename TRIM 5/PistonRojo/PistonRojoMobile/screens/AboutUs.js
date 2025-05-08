import React from 'react';
import { View, Text, StyleSheet } from 'react-native';

const AboutUs = () => {
  return (
    <View style={styles.container}>
      <Text style={styles.title}>Sobre Nosotros</Text>
      <Text style={styles.description}>
        Somos una microempresa dedicada al mantenimiento y reparación de motocicletas.
      </Text>
    </View>
  );
};

const styles = StyleSheet.create({
  container: { flex: 1, justifyContent: 'center', alignItems: 'center', padding: 20 },
  title: { fontSize: 24, fontWeight: 'bold', marginBottom: 20 },
  description: { fontSize: 16, textAlign: 'center', color: '#555' },
});

export default AboutUs;