# Rentify – Gestión de contratos de alquiler

- Rentify es una aplicación web inicialmente desarrollada como **plugin de WordPress** pero diseñada con una arquitectura modular que permite ejecutarse en **cualquier entorno PHP**. Con el objetivo de brindar un sistema claro y centralizado de seguimiento de vencimientos de contratos, alertas y documentación asociada.  

- El proyecto está preparado para ejecutarse en entornos reproducibles mediante **Docker Compose**, garantizando portabilidad y facilidad de despliegue. 

- Gracias a esta estructura, Rentify puede funcionar tanto dentro de WordPress (con Hello Elementor como theme base y el theme‑rentify‑child, no incluido en este repositorio) como de manera autónoma, **desplegable en cualquier plataforma**.  

---

## ✅ Funcionalidades principales

- **Carga de contratos mediante formularios personalizados**: cada contrato se ingresa con sus datos clave y un enlace a la documentación asociada (por ejemplo, carpetas en Google Drive).  
- **Historial visual con urgencias**: panel centralizado que muestra todos los contratos, con colores de fondo según la proximidad de la fecha de vencimiento (configurable según necesidades).  
- **Gestión de notas y observaciones**: cada contrato admite comentarios adicionales, editables desde el historial.  
- **Notificaciones automáticas por mail**: el sistema envía alertas con antelación a las partes involucradas, evitando que los vencimientos pasen desapercibidos.  
- **Escalabilidad**: pensado para funcionar en WordPress o como aplicación independiente.

---

## ⚙️ Aspectos técnicos

- **Stack reproducible y portable**: PHP 8.2 + MySQL 8.0 en Docker Compose.
- **Gestión de dependencias**: Composer con autoload PSR-4.
- **Arquitectura**:
    - Todo el código fuente se mantiene en la carpeta app/.
    - Se elimina la carpeta src/ para mantener coherencia entre entornos. 
    - El namespace raíz es Rentify\Rentify, mapeado directamente a app/.
- **Despliegue flexible**: WordPress con theme‑rentify‑child (instalado junto a Hello Elementor) o como aplicación autónoma en cualquier plataforma.

---

## 📖 En pocas palabras

Rentify es una herramienta pensada para que instituciones y profesionales puedan **gestionar contratos de alquiler sin perder de vista fechas críticas**. Con formularios claros, alertas automáticas, historial visual con colores según urgencia y la posibilidad de adjuntar documentación en la nube, se convierte en un sistema confiable y fácil de usar para centralizar toda la información en un solo lugar.
Su diseño modular asegura que pueda crecer y adaptarse a distintos entornos sin perder coherencia ni estabilidad.

---

## 🛡️ Licencia

Este proyecto es de uso institucional y propietario.  
El código puede ser consultado públicamente, pero **no está permitido su uso, copia, modificación ni redistribución** sin autorización expresa del autor.  
Todos los derechos reservados © 2026 SolariDev.