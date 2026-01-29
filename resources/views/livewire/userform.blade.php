<div class="row">
    <div class="col-md-12  col-lg-9 col-xl-9 mb-3">
        <label class="form-label required">Nome</label>
        <x-form.input-text name="user.name" wire:model="user.name" />
    </div>

    <div class="col-md-4 col-lg-3 col-xl-3 mb-3">
        <label class="form-label">Apelido</label>
        <x-form.input-text wire:model='user.nickname' name="user.nickname" />
    </div>

    <div class="col-md-4 col-lg-4 col-xl-3 mb-3">
        <label class="form-label required">Data Nasc</label>
        <x-form.input-text type="date" wire:model='user.birthdate' name="user.birthdate" />
    </div>

    <div class="col-md-4 col-lg-4 col-xl-3 mb-3">
        <label class="form-label required">Sexo</label>
        <x-form.select-gender wire:model='user.gender' name="user.gender" />
    </div>

    <div class="col-md-4 col-lg-4 col-xl-3 mb-3">
        <label class="form-label required">CPF</label>
        <x-form.input-text type="number" wire:model='user.cpf' name="user.cpf" />
    </div>

    <div class="col-md-4 col-lg-3 col-xl-3 mb-3">
        <label class="form-label required">Tel. WhatsApp</label>
        <x-form.input-text wire:model='user.phone1' name="user.phone1" />
    </div>

    <div class="col-md-4 col-lg-3 col-xl-3 mb-3">
        <label class="form-label">Tel. Recado</label>
        <x-form.input-text wire:model='user.phone2' name="user.phone2" />
    </div>

    <div class="col-md-12 col-lg-6 col-xl-9 mb-3">
        <label class="form-label">E-mail</label>
        <x-form.input-text type="email" wire:model='user.email' name="user.email" />
    </div>
</div>
{{-- <hr>
<h4><strong>Endereço</strong></h4> --}}
<div class="row ">
    <div class="col-md-3 col-lg-3 col-xl-3 mb-3">
        <label class="form-label">CEP</label>
        <input type="number" class="form-control @error('user.zipcode') is-invalid @enderror" wire:model="user.zipcode" wire:blur.lazy="getAddress" />
    </div>

    <div class="col-md-7 col-lg-9 col-xl-7 mb-3">
        <label class="form-label">Rua</label>
        <x-form.input-text wire:model='user.address' name="user.address" loading="true" />
    </div>

    <div class="col-md-2 col-lg-2 col-xl-2 mb-3">
        <label class="form-label">Nº</label>
        <x-form.input-text wire:model='user.number' name="user.number" />
    </div>

    <div class="col-md-4 col-lg-10 col-xl-3 mb-3">
        <label class="form-label">Complemento</label>
        <x-form.input-text wire:model='user.complement' name="user.complement" />
    </div>

    <div class="col-md-4 col-lg-5 col-xl-3 mb-3">
        <label class="form-label">Bairro</label>
        <x-form.input-text wire:model='user.district' name="user.district" loading="true" />
    </div>

    <div class="col-md-3 col-lg-5 col-xl-4 mb-3">
        <label class="form-label">Cidade</label>
        <x-form.input-text wire:model='user.city' name="user.city" loading="true" />
    </div>

    <div class="col-md-1 col-lg-2 col-xl-2 mb-3">
        <label class="form-label">UF</label>
        <x-form.input-text wire:model='user.state' name="user.state" loading="true" />
    </div>
</div>