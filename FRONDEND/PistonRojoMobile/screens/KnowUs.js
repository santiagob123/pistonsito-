import React from 'react';
import { View, Text, StyleSheet } from 'react-native';

const KnowUs = () => {
  return (
    <View style={styles.container}>
      <Text style={styles.title}>Conócenos</Text>
      <Text style={styles.description}>
        Visítanos en nuestra sede en Bogotá, Colombia.
      </Text>
    </View>
  );
};

const styles = StyleSheet.create({
  container: { flex: 1, justifyContent: 'center', alignItems: 'center', padding: 20 },
  title: { fontSize: 24, fontWeight: 'bold', marginBottom: 20 },
  description: { fontSize: 16, textAlign: 'center', color: '#555' },
});

export default KnowUs;