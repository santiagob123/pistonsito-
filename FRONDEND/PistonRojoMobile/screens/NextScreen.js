import React from 'react';
import { View, Text, StyleSheet } from 'react-native';

const NextScreen = () => {
  return (
    <View style={styles.container}>
      <Text style={styles.title}>¡Bienvenido!</Text>
      <Text style={styles.description}>
        Esta es la pantalla a la que serás redirigido después de iniciar sesión.
      </Text>
    </View>
  );
};

const styles = StyleSheet.create({
  container: { flex: 1, justifyContent: 'center', alignItems: 'center', padding: 20 },
  title: { fontSize: 24, fontWeight: 'bold', marginBottom: 20 },
  description: { fontSize: 16, textAlign: 'center', color: '#555' },
});

export default NextScreen;