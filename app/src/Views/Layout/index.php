{% extends 'Templates/main.php' %}

{% block content %}
<div class="container">
	<div class="row">
    <div class="col-md-12">
      <div class="card rounded-0">
        <div class="card-body">
            <h4 class="card-title text-info">Validación de CFDI en Serie</h4>
            <table id="mytable" class="table table-bordred table-striped table-hover">
              <thead>       
                <th class="text-primary">RFC Emisor</th>
                <th class="text-primary">RFC Receptor</th>
                <th class="text-primary">UUID</th>
                <th class="text-primary">Total</th>
                <th class="text-primary">Estado</th>        
              </thead>
              <tbody>
              {% for item in lista %}
                <tr>
                  <td class="text-info">{{item.rfcEmisor}}</td>
                  <td class="text-info">{{item.rfcReceptor}}</td>
                  <td class="text-info">{{item.uuid}}</td>
                  <td class="text-info">${{item.total}}</td>
                  {% if item.status=='-1' %}
                  <td class="text-warning"><i class="fas fa-question"></i></td>
                  {% elseif item.status=='0' %}
                  <td class="text-danger"><i class="fas fa-ban"></i></td>
                  {% else %}
                  <td class="text-success"><i class="fas fa-check"></i></td>
                  {% endif %}
                </tr>
              {% endfor %}
              </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>
{% endblock %}

