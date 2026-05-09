# Rentify – Gestión de contratos de alquiler

Rentify es una aplicación web desarrollada como **plugin de WordPress**, diseñada para brindar un sistema claro y centralizado de seguimiento de vencimientos de contratos, alertas y documentación asociada.  
El proyecto está preparado para ejecutarse en entornos reproducibles mediante **Docker Compose**, garantizando portabilidad y facilidad de despliegue.

---

## ✅ Funcionalidades principales

- **Carga de contratos mediante formularios personalizados**: cada contrato se ingresa con sus datos clave y un enlace a la documentación asociada (por ejemplo, carpetas en Google Drive).  
- **Historial visual con urgencias**: panel centralizado que muestra todos los contratos, con colores de fondo según la proximidad de la fecha de vencimiento (configurable según necesidades).  
- **Gestión de notas y observaciones**: cada contrato admite comentarios adicionales, editables desde el historial.  
- **Notificaciones automáticas por mail**: el sistema envía alertas con antelación a las partes involucradas, evitando que los vencimientos pasen desapercibidos.  
- **Integración nativa con WordPress**: se instala y administra como cualquier otro plugin, con soporte de temas padre e hijo para personalización visual.  

---

  ## ⚙️ Aspectos técnicos

- **Stack**: WordPress 6.9.4, PHP 8.2, Apache, MySQL 8.0.  
- **Administración**: phpMyAdmin incluido en el entorno Docker.  
- **Estructura principal**:  
  - `plugins/rentify` → lógica de negocio del plugin.  
  - `themes/theme-rentify-child` → personalización visual sobre Hello Elementor.  
  - Configuración reproducible con `.env` y `docker-compose.yml`.  
- **Compatibilidad**: validado en entornos Docker y en instalaciones estándar de WordPress.

---

## 📖 En pocas palabras

Rentify es una herramienta pensada para que instituciones y profesionales puedan **gestionar contratos de alquiler sin perder de vista fechas críticas**.  
Con formularios claros, alertas automáticas, historial visual con colores según urgencia y la posibilidad de adjuntar documentación en la nube, se convierte en un sistema confiable y fácil de usar para centralizar toda la información en un solo lugar.

---

## 🛡️ Licencia

Este proyecto es de uso institucional y propietario.  
El código puede ser consultado públicamente, pero **no está permitido su uso, copia, modificación ni redistribución** sin autorización expresa del autor.  
Todos los derechos reservados © 2026 SolariDev.