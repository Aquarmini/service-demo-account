{% extends "master.volt" %}
{% block content %}
    <div id="app"></div>
    <script src="/dist/vendor.js?v=0.0.1"></script>
    <script src="/dist/client.js?v={{ v }}"></script>
{% endblock %}
