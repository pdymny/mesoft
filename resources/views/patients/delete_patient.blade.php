<div wire:ignore.self class="modal fade" id="deletePatient">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Usuń pacjenta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Zamknij">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          Czy na pewno chcesz usunąć pacjenta <b>{{ $patient->firstname }} {{ $patient->name }}</b>?
        </div>
        <div class="modal-footer">
          <button class="btn btn-outline-primary" data-dismiss="modal">Nie usuwaj</button>
          <button type="button" wire:click="deletePatient" class="btn btn-outline-danger">Usuń pacjenta</button>
        </div>
    </div>
  </div>
</div>